<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-slate-800">Selamat Datang di E-Modul</h2>
        <p class="mt-2 text-sm text-slate-500">Pilih peran Anda untuk masuk atau mendaftar</p>
    </div>

    {{-- Dua kartu pilihan --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

        {{-- Kartu Siswa --}}
        <div class="flex flex-col items-center gap-4 p-6 bg-white/60 backdrop-blur-xl border border-white/70 rounded-3xl shadow-md shadow-sky-200/30 hover:shadow-lg hover:-translate-y-0.5 transition duration-300">
            <div class="w-16 h-16 rounded-2xl bg-sky-100/80 flex items-center justify-center text-3xl shadow-inner">
                🎒
            </div>
            <div class="text-center">
                <h3 class="text-lg font-bold text-slate-800">Siswa</h3>
                <p class="text-xs text-slate-500 mt-1">Akses modul pelajaran dari guru Anda</p>
            </div>
            <div class="w-full flex flex-col gap-2 mt-1">
                <a href="{{ route('siswa.login') }}"
                   class="w-full text-center py-2.5 px-4 rounded-2xl text-sm font-semibold text-white bg-gradient-to-r from-sky-400 to-indigo-400 hover:from-sky-500 hover:to-indigo-500 hover:-translate-y-0.5 transition duration-300 shadow-md shadow-sky-200/50">
                    Masuk sebagai Siswa
                </a>
                <a href="{{ route('siswa.daftar') }}"
                   class="w-full text-center py-2.5 px-4 rounded-2xl text-sm font-medium text-sky-700 bg-sky-50/80 border border-sky-200/60 hover:bg-sky-100/80 transition duration-300">
                    Daftar Siswa Baru
                </a>
            </div>
        </div>

        {{-- Kartu Guru --}}
        <div class="flex flex-col items-center gap-4 p-6 bg-white/60 backdrop-blur-xl border border-white/70 rounded-3xl shadow-md shadow-violet-200/30 hover:shadow-lg hover:-translate-y-0.5 transition duration-300">
            <div class="w-16 h-16 rounded-2xl bg-violet-100/80 flex items-center justify-center text-3xl shadow-inner">
                📚
            </div>
            <div class="text-center">
                <h3 class="text-lg font-bold text-slate-800">Guru</h3>
                <p class="text-xs text-slate-500 mt-1">Kelola dan unggah modul untuk siswa</p>
            </div>
            <div class="w-full flex flex-col gap-2 mt-1">
                <a href="{{ route('guru.login') }}"
                   class="w-full text-center py-2.5 px-4 rounded-2xl text-sm font-semibold text-white bg-gradient-to-r from-violet-400 to-indigo-400 hover:from-violet-500 hover:to-indigo-500 hover:-translate-y-0.5 transition duration-300 shadow-md shadow-violet-200/50">
                    Masuk sebagai Guru
                </a>
                <a href="{{ route('guru.daftar') }}"
                   class="w-full text-center py-2.5 px-4 rounded-2xl text-sm font-medium text-violet-700 bg-violet-50/80 border border-violet-200/60 hover:bg-violet-100/80 transition duration-300">
                    Daftar Guru Baru
                </a>
            </div>
        </div>

    </div>

    <p class="text-center text-xs text-slate-400 mt-6">
        Pendaftaran memerlukan persetujuan kepala sekolah.
    </p>
</x-guest-layout>
