<x-app-layout>
    @section('title', 'Dashboard Siswa')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-100 leading-tight">Dashboard Siswa</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-card>
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-indigo-50 dark:bg-indigo-950/40 rounded-2xl flex items-center justify-center text-indigo-600 dark:text-indigo-400 flex-shrink-0">
                        <x-icon name="siswa" class="w-7 h-7" />
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100">Selamat datang, {{ $user->name }}</h3>
                        <p class="text-slate-500 dark:text-slate-400 mt-1">Anda masuk sebagai <span class="font-semibold text-indigo-600 dark:text-indigo-400">Siswa</span>.</p>
                    </div>
                </div>
            </x-card>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('siswa.kelas.index') }}"
                   class="stagger-item flex items-center gap-4 bg-white/80 dark:bg-slate-900/80 border border-slate-200/80 dark:border-slate-800 rounded-3xl shadow-sm dark:shadow-none hover:shadow-md hover:-translate-y-1 transition duration-300 ease-out p-6 group">
                    <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-950/40 rounded-2xl flex items-center justify-center text-indigo-600 dark:text-indigo-400 flex-shrink-0">
                        <x-icon name="buku" class="w-6 h-6" />
                    </div>
                    <div>
                        <p class="font-semibold text-slate-800 dark:text-slate-100 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 text-base transition duration-300">Jelajahi Modul</p>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Pilih kelas, mata pelajaran, dan baca modul PDF.</p>
                    </div>
                </a>

                <a href="{{ route('profile.edit') }}"
                   class="stagger-item flex items-center gap-4 bg-white/80 dark:bg-slate-900/80 border border-slate-200/80 dark:border-slate-800 rounded-3xl shadow-sm dark:shadow-none hover:shadow-md hover:-translate-y-1 transition duration-300 ease-out p-6 group">
                    <div class="w-12 h-12 bg-slate-100 dark:bg-slate-800 rounded-2xl flex items-center justify-center text-slate-600 dark:text-slate-300 flex-shrink-0">
                        <x-icon name="pengguna" class="w-6 h-6" />
                    </div>
                    <div>
                        <p class="font-semibold text-slate-800 dark:text-slate-100 text-base group-hover:text-slate-900 dark:group-hover:text-slate-200 transition duration-300">Profil Saya</p>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Ubah nama, email, atau kata sandi.</p>
                    </div>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
