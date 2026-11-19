FROM dunglas/frankenphp:1-php8.4-bookworm AS base

RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && install-php-extensions intl zip pdo_sqlite

WORKDIR /app

FROM base AS dependencies

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --no-scripts \
    --optimize-autoloader \
    --prefer-dist

COPY . .
RUN mkdir -p \
        storage/framework/cache \
        storage/framework/sessions \
        storage/framework/views \
        bootstrap/cache \
        database \
    && composer dump-autoload --no-dev --classmap-authoritative

# Buat database SQLite + isi data awal saat build (admin, guru, siswa, kelas, mapel)
RUN touch database/database.sqlite \
    && APP_ENV=local DB_CONNECTION=sqlite DB_DATABASE=/app/database/database.sqlite \
       php artisan migrate --seed --force

# Build CSS/JS (Vite). Memakai vendor dari tahap sebelumnya agar Tailwind
# bisa membaca view bawaan Laravel (pagination).
FROM node:22-bookworm-slim AS assets

WORKDIR /app
COPY --from=dependencies /app /app
RUN npm ci --ignore-scripts && npm run build

FROM base AS runtime

COPY --from=dependencies --chown=www-data:www-data /app /app
COPY --from=assets --chown=www-data:www-data /app/public/build /app/public/build
COPY --chown=www-data:www-data Caddyfile /etc/frankenphp/Caddyfile

RUN setcap CAP_NET_BIND_SERVICE=+eip /usr/local/bin/frankenphp \
    && chown -R www-data:www-data /config/caddy /data/caddy /app/database

ENV PORT=80 \
    APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    CACHE_STORE=array \
    SESSION_DRIVER=cookie \
    QUEUE_CONNECTION=sync \
    DB_CONNECTION=sqlite \
    DB_DATABASE=/app/database/database.sqlite

USER www-data

CMD ["frankenphp", "run", "--config", "/etc/frankenphp/Caddyfile"]
