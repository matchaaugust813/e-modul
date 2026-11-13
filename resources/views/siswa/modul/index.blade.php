<x-app-layout>
    @section('title', 'Modul ' . $mataPelajaran->nama)
    <x-slot name="header">
        <div class="flex items-center gap-2 text-slate-700 text-sm flex-wrap">
            <a href="{{ route('siswa.kelas.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium transition duration-300">Kelas</a>
            <span class="text-slate-400">/</span>
            <a href="{{ route('siswa.mapel.index', $kelas) }}" class="text-indigo-600 hover:text-indigo-800 font-medium transition duration-300">{{ $kelas->label }}</a>
            <span class="text-slate-400">/</span>
            <span class="font-semibold text-slate-800 text-base">{{ $mataPelajaran->nama }}</span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if ($moduls->isEmpty())
                <x-card>
                    <p class="text-slate-500 text-center py-6">Belum ada modul untuk mata pelajaran ini.</p>
                </x-card>
            @else
                <div class="space-y-4">
                    @foreach ($moduls as $modul)
                        <div class="stagger-item flex flex-col sm:flex-row sm:items-center justify-between bg-white/80 border border-slate-200/80 rounded-3xl shadow-sm hover:shadow-md hover:-translate-y-0.5 transition duration-300 ease-out p-5 gap-4">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center">
                                    <x-icon name="dokumen" class="w-6 h-6" />
                                </div>
                                <div>
                                    <h4 class="font-semibold text-slate-800 text-base">{{ $modul->judul }}</h4>
                                    @if ($modul->deskripsi)
                                        <p class="text-sm text-slate-600 mt-1">{{ $modul->deskripsi }}</p>
                                    @endif
                                    <p class="text-xs text-slate-500 mt-2">
                                        Pengunggah: {{ $modul->guru->name ?? '-' }}
                                        &bull;
                                        {{ format_ukuran($modul->ukuran) }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-2 shrink-0">
                                <x-btn-primary href="{{ route('siswa.modul.baca', $modul) }}">
                                    <x-icon name="baca" class="w-4 h-4 inline mr-1" />
                                    Baca
                                </x-btn-primary>
                                <x-btn-secondary href="{{ route('siswa.modul.unduh', $modul) }}">
                                    <x-icon name="unduh" class="w-4 h-4 inline mr-1" />
                                    Unduh
                                </x-btn-secondary>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
