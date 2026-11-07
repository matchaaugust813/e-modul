<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">Dashboard Siswa</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-card>
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-emerald-100/70 rounded-2xl flex items-center justify-center text-3xl flex-shrink-0">🎒</div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800">Selamat datang, {{ $user->name }}!</h3>
                        <p class="text-slate-500 mt-1">Anda login sebagai <span class="font-semibold text-emerald-600">Siswa</span>.</p>
                    </div>
                </div>
            </x-card>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('siswa.kelas.index') }}"
                   class="stagger-item flex items-center gap-4 bg-gradient-to-br from-emerald-50 to-sky-50 backdrop-blur-2xl border border-white/60 rounded-3xl shadow-lg shadow-emerald-200/30 hover:shadow-xl hover:-translate-y-1.5 transition duration-300 ease-out p-6 group">
                    <div class="w-12 h-12 bg-emerald-100/80 rounded-2xl flex items-center justify-center text-2xl flex-shrink-0">📚</div>
                    <div>
                        <p class="font-semibold text-slate-800 group-hover:text-emerald-700 text-base transition duration-300">Jelajahi Modul</p>
                        <p class="text-sm text-slate-500">Pilih kelas, mata pelajaran, dan baca modul PDF.</p>
                    </div>
                </a>

                <a href="{{ route('profile.edit') }}"
                   class="stagger-item flex items-center gap-4 bg-gradient-to-br from-violet-50 to-sky-50 backdrop-blur-2xl border border-white/60 rounded-3xl shadow-lg shadow-violet-200/30 hover:shadow-xl hover:-translate-y-1.5 transition duration-300 ease-out p-6 group">
                    <div class="w-12 h-12 bg-violet-100/80 rounded-2xl flex items-center justify-center text-2xl flex-shrink-0">👤</div>
                    <div>
                        <p class="font-semibold text-slate-800 text-base group-hover:text-violet-700 transition duration-300">Profil Saya</p>
                        <p class="text-sm text-slate-500">Ubah nama, email, atau kata sandi.</p>
                    </div>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
