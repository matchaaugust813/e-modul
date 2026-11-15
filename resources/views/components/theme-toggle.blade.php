<div
    x-data="{
        current: (window.__emodulTheme ? window.__emodulTheme.get() : 'system'),
        setTheme(val) {
            this.current = val;
            if (window.__emodulTheme) {
                window.__emodulTheme.set(val);
            }
        },
        init() {
            window.addEventListener('emodul-theme-change', (e) => {
                this.current = e.detail.theme;
            });
        },
        onKeydown(e) {
            const options = ['light', 'dark', 'system'];
            const idx = options.indexOf(this.current);
            if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
                e.preventDefault();
                const next = options[(idx + 1) % options.length];
                this.setTheme(next);
                this.$nextTick(() => {
                    if (this.$refs[next + 'Btn']) this.$refs[next + 'Btn'].focus();
                });
            } else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
                e.preventDefault();
                const prev = options[(idx - 1 + options.length) % options.length];
                this.setTheme(prev);
                this.$nextTick(() => {
                    if (this.$refs[prev + 'Btn']) this.$refs[prev + 'Btn'].focus();
                });
            }
        }
    }"
    role="radiogroup"
    aria-label="Pilihan tema tampilan"
    class="inline-flex items-center p-1 rounded-2xl bg-white/60 dark:bg-slate-900/80 border border-white/60 dark:border-white/10 shadow-sm backdrop-blur-xl gap-1"
>
    <!-- Opsi Terang -->
    <button
        type="button"
        role="radio"
        x-ref="lightBtn"
        :aria-checked="current === 'light'"
        :tabindex="current === 'light' ? 0 : -1"
        aria-label="Tema terang"
        @click="setTheme('light')"
        @keydown="onKeydown($event)"
        class="min-w-[40px] min-h-[40px] w-10 h-10 flex items-center justify-center rounded-xl transition duration-150 focus-visible:ring-2 focus-visible:ring-indigo-400"
        :class="current === 'light' ? 'bg-white dark:bg-slate-800 text-indigo-600 dark:text-indigo-400 shadow-sm border border-slate-200/50 dark:border-slate-700' : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 hover:bg-white/40 dark:hover:bg-slate-800/40'"
    >
        <x-icon name="matahari" class="w-5 h-5" />
    </button>

    <!-- Opsi Gelap -->
    <button
        type="button"
        role="radio"
        x-ref="darkBtn"
        :aria-checked="current === 'dark'"
        :tabindex="current === 'dark' ? 0 : -1"
        aria-label="Tema gelap"
        @click="setTheme('dark')"
        @keydown="onKeydown($event)"
        class="min-w-[40px] min-h-[40px] w-10 h-10 flex items-center justify-center rounded-xl transition duration-150 focus-visible:ring-2 focus-visible:ring-indigo-400"
        :class="current === 'dark' ? 'bg-white dark:bg-slate-800 text-indigo-600 dark:text-indigo-400 shadow-sm border border-slate-200/50 dark:border-slate-700' : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 hover:bg-white/40 dark:hover:bg-slate-800/40'"
    >
        <x-icon name="bulan" class="w-5 h-5" />
    </button>

    <!-- Opsi Ikuti Sistem -->
    <button
        type="button"
        role="radio"
        x-ref="systemBtn"
        :aria-checked="current === 'system'"
        :tabindex="current === 'system' ? 0 : -1"
        aria-label="Ikuti sistem"
        @click="setTheme('system')"
        @keydown="onKeydown($event)"
        class="min-w-[40px] min-h-[40px] w-10 h-10 flex items-center justify-center rounded-xl transition duration-150 focus-visible:ring-2 focus-visible:ring-indigo-400"
        :class="current === 'system' ? 'bg-white dark:bg-slate-800 text-indigo-600 dark:text-indigo-400 shadow-sm border border-slate-200/50 dark:border-slate-700' : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 hover:bg-white/40 dark:hover:bg-slate-800/40'"
    >
        <x-icon name="monitor" class="w-5 h-5" />
    </button>
</div>
