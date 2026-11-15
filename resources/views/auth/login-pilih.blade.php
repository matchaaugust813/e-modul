<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Selamat Datang di E-Modul</h2>
        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Pilih peran Anda untuk masuk atau mendaftar</p>
    </div>

    {{-- Dua kartu pilihan --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

        {{-- Kartu Siswa --}}
        <div class="flex flex-col items-center gap-4 p-6 bg-white/80 dark:bg-slate-900/80 border border-slate-100 dark:border-slate-800 rounded-3xl shadow-sm dark:shadow-none hover:shadow-md hover:-translate-y-0.5 transition duration-300">
            <div class="w-16 h-16 rounded-2xl bg-sky-100 dark:bg-sky-950/40 flex items-center justify-center text-sky-600 dark:text-sky-400 shadow-inner">
                <x-icon name="siswa" class="w-8 h-8" />
            </div>
            <div class="text-center">
                <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Siswa</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Akses modul pelajaran dari guru Anda</p>
            </div>
            <div class="w-full flex flex-col gap-2 mt-1">
                <a href="{{ route('siswa.login') }}"
                   class="w-full text-center py-2.5 px-4 rounded-2xl text-sm font-semibold text-white bg-gradient-to-r from-sky-500 to-indigo-500 hover:from-sky-600 hover:to-indigo-600 transition duration-300 shadow-sm dark:shadow-none">
                    Masuk sebagai Siswa
                </a>
                <a href="{{ route('siswa.daftar') }}"
                   class="w-full text-center py-2.5 px-4 rounded-2xl text-sm font-medium text-sky-700 dark:text-sky-300 bg-sky-50 dark:bg-sky-950/40 border border-sky-200/60 dark:border-sky-800/60 hover:bg-sky-100 dark:hover:bg-sky-900/40 transition duration-300">
                    Daftar Siswa Baru
                </a>
            </div>
        </div>

        {{-- Kartu Guru --}}
        <div class="flex flex-col items-center gap-4 p-6 bg-white/80 dark:bg-slate-900/80 border border-slate-100 dark:border-slate-800 rounded-3xl shadow-sm dark:shadow-none hover:shadow-md hover:-translate-y-0.5 transition duration-300">
            <div class="w-16 h-16 rounded-2xl bg-violet-100 dark:bg-violet-950/40 flex items-center justify-center text-violet-600 dark:text-violet-400 shadow-inner">
                <x-icon name="guru" class="w-8 h-8" />
            </div>
            <div class="text-center">
                <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Guru</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Kelola dan unggah modul untuk siswa</p>
            </div>
            <div class="w-full flex flex-col gap-2 mt-1">
                <a href="{{ route('guru.login') }}"
                   class="w-full text-center py-2.5 px-4 rounded-2xl text-sm font-semibold text-white bg-gradient-to-r from-violet-500 to-indigo-500 hover:from-violet-600 hover:to-indigo-600 transition duration-300 shadow-sm dark:shadow-none">
                    Masuk sebagai Guru
                </a>
                <a href="{{ route('guru.daftar') }}"
                   class="w-full text-center py-2.5 px-4 rounded-2xl text-sm font-medium text-violet-700 dark:text-violet-300 bg-violet-50 dark:bg-violet-950/40 border border-violet-200/60 dark:border-violet-800/60 hover:bg-violet-100 dark:hover:bg-violet-900/40 transition duration-300">
                    Daftar Guru Baru
                </a>
            </div>
        </div>

    </div>

    <p class="text-center text-xs text-slate-400 dark:text-slate-500 mt-6">
        Pendaftaran memerlukan persetujuan kepala sekolah.
    </p>
</x-guest-layout>
