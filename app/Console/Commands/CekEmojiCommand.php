<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

class CekEmojiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ui:cek-emoji';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pindai dan pastikan tidak ada karakter emoji atau simbol terlarang di kode sumber';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $basePath = base_path();

        $targetPaths = [
            'resources/views',
            'resources/css',
            'resources/js',
            'app',
            'routes',
            'config',
            'lang',
            'database/seeders',
            'database/factories',
            'tests',
            'README.md',
            '.env.example',
        ];

        // Regex karakter terlarang sesuai Tahap 4C
        $pattern = '/[\x{1F000}-\x{1FAFF}\x{2600}-\x{27BF}\x{2B00}-\x{2BFF}\x{2300}-\x{23FF}\x{FE0F}\x{200D}\x{3030}\x{303D}]/u';

        $findings = [];

        foreach ($targetPaths as $relPath) {
            $fullPath = $basePath . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relPath);

            if (!file_exists($fullPath)) {
                continue;
            }

            if (is_file($fullPath)) {
                $this->scanFile($fullPath, $basePath, $pattern, $findings);
                continue;
            }

            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($fullPath, RecursiveDirectoryIterator::SKIP_DOTS)
            );

            /** @var SplFileInfo $file */
            foreach ($iterator as $file) {
                if ($file->isDir()) {
                    continue;
                }

                $filePath = $file->getPathname();

                // Abaikan vendor, node_modules, storage, public/build
                if (
                    str_contains($filePath, DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR) ||
                    str_contains($filePath, DIRECTORY_SEPARATOR . 'node_modules' . DIRECTORY_SEPARATOR) ||
                    str_contains($filePath, DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR) ||
                    str_contains($filePath, DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'build' . DIRECTORY_SEPARATOR)
                ) {
                    continue;
                }

                $this->scanFile($filePath, $basePath, $pattern, $findings);
            }
        }

        if (empty($findings)) {
            $this->info('Bersih: Tidak ada emoji atau simbol terlarang yang ditemukan.');
            return Command::SUCCESS;
        }

        $this->error('Ditemukan ' . count($findings) . ' temuan karakter emoji/simbol terlarang:');
        foreach ($findings as $finding) {
            $this->line(sprintf('<fg=yellow>%s:%d</> <fg=red>[%s]</> %s', $finding['path'], $finding['line'], $finding['char'], $finding['content']));
        }

        return Command::FAILURE;
    }

    protected function scanFile(string $fullPath, string $basePath, string $pattern, array &$findings): void
    {
        $content = @file_get_contents($fullPath);
        if ($content === false) {
            return;
        }

        $lines = explode("\n", $content);
        $relPath = ltrim(str_replace($basePath, '', $fullPath), DIRECTORY_SEPARATOR);
        $relPath = str_replace('\\', '/', $relPath);

        foreach ($lines as $index => $line) {
            if (preg_match_all($pattern, $line, $matches)) {
                $uniqueChars = array_unique($matches[0]);
                $findings[] = [
                    'path' => $relPath,
                    'line' => $index + 1,
                    'char' => implode(' ', $uniqueChars),
                    'content' => trim($line),
                ];
            }
        }
    }
}
