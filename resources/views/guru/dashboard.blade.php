<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">Dashboard Guru</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-card>
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-indigo-100/70 rounded-2xl flex items-center justify-center text-3xl flex-shrink-0">🏫</div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800">Selamat datang, {{ $user->name }}!</h3>
                        <p class="text-slate-500 mt-1">Anda login sebagai <span class="font-semibold text-indigo-600">Guru</span>.</p>
                    </div>
                </div>
            </x-card>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-card class="stagger-item">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0 p-3 bg-indigo-100/70 rounded-2xl">
                            <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
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
