<x-app-layout>
    @section('title', 'Dashboard Guru')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">Dashboard Guru</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-card>
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center text-indigo-600 flex-shrink-0">
                        <x-icon name="sekolah" class="w-7 h-7" />
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800">Selamat datang, {{ $user->name }}</h3>
                        <p class="text-slate-500 mt-1">Anda masuk sebagai <span class="font-semibold text-indigo-600">Guru</span>.</p>
                    </div>
                </div>
            </x-card>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-card class="stagger-item">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0 p-3 bg-indigo-100 rounded-2xl text-indigo-600">
                            <x-icon name="dokumen" class="w-6 h-6" />
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Total Modul Anda</p>
                            <p class="text-2xl font-bold text-slate-800">
                                {{ \App\Models\Modul::where('guru_id', auth()->id())->count() }}
                            </p>
                        </div>
                    </div>
                </x-card>

                <x-card class="stagger-item">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500 mb-1">Kelola Modul</p>
                            <p class="text-slate-600 text-sm">Tambah, ubah, atau hapus modul Anda.</p>
                        </div>
                        <x-btn-primary href="{{ route('guru.modul.index') }}">
                            Lihat Modul
                        </x-btn-primary>
                    </div>
                </x-card>
            </div>

        </div>
    </div>
</x-app-layout>
