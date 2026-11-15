<x-guest-layout>
    <div class="text-center">
        {{-- Ikon sukses --}}
        <div class="mx-auto w-20 h-20 rounded-full bg-emerald-100 dark:bg-emerald-950/40 flex items-center justify-center text-emerald-600 dark:text-emerald-400 mb-6 shadow-inner">
            <x-icon name="centang" class="w-10 h-10" />
        </div>

        <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Pendaftaran Berhasil Dikirim</h2>

        <p class="mt-4 text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
            Akun Anda telah didaftarkan dan sedang menunggu persetujuan kepala sekolah.
            Anda akan dapat masuk setelah akun disetujui.
        </p>

        @if (session('success'))
            <div class="mt-5 p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200/60 dark:border-emerald-800/60 text-sm text-emerald-700 dark:text-emerald-300">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-6 p-5 rounded-2xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200/60 dark:border-amber-800/60 text-left">
            <div class="flex items-start gap-3">
                <x-icon name="jam" class="w-5 h-5 text-amber-700 dark:text-amber-400 mt-0.5 flex-shrink-0" />
                <div>
                    <p class="text-sm font-semibold text-amber-800 dark:text-amber-300">Menunggu Persetujuan</p>
                    <p class="text-xs text-amber-700 dark:text-amber-400 mt-1">
                        Kepala sekolah akan meninjau pendaftaran Anda. Proses ini membutuhkan
                        1–2 hari kerja. Pantau email Anda untuk informasi lebih lanjut.
                    </p>
                </div>
            </div>
        </div>

        <a href="{{ url('/') }}"
           class="mt-8 inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl text-sm font-semibold text-slate-700 dark:text-slate-200 bg-white/80 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700 hover:bg-white dark:hover:bg-slate-700 hover:-translate-y-0.5 transition duration-300 shadow-sm dark:shadow-none">
            Kembali ke Halaman Utama
        </a>
    </div>
</x-guest-layout>
