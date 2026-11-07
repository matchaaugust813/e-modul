<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-slate-700 text-sm flex-wrap">
            <a href="{{ route('siswa.kelas.index') }}" class="text-indigo-500 hover:text-indigo-700 font-medium transition duration-300">Kelas</a>
            <span class="text-slate-300">/</span>
            <a href="{{ route('siswa.mapel.index', $kelas) }}" class="text-indigo-500 hover:text-indigo-700 font-medium transition duration-300">{{ $kelas->label }}</a>
            <span class="text-slate-300">/</span>
            <span class="font-semibold text-slate-800 text-base">{{ $mataPelajaran->nama }}</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if ($moduls->isEmpty())
                <x-card>
                    <p class="text-slate-400 text-center">Belum ada modul untuk mata pelajaran ini.</p>
                </x-card>
            @else
                <div class="space-y-4">
                    @foreach ($moduls as $modul)
                        <div class="stagger-item flex flex-col sm:flex-row sm:items-center justify-between bg-white/50 backdrop-blur-2xl border border-white/60 rounded-3xl shadow-lg shadow-indigo-200/20 hover:bg-white/70 hover:-translate-y-0.5 transition duration-300 ease-out p-5 gap-4">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-indigo-100/70 rounded-2xl flex items-center justify-center text-2xl">📄</div>
                                <div>
                                    <h4 class="font-semibold text-slate-800 text-base">{{ $modul->judul }}</h4>
                                    @if ($modul->deskripsi)
                                        <p class="text-sm text-slate-500 mt-1">{{ $modul->deskripsi }}</p>
                                    @endif
                                    <p class="text-xs text-slate-400 mt-2">
                                        Oleh {{ $modul->guru->name ?? '-' }}
                                        &bull;
                                        {{ number_format($modul->ukuran / 1024, 1) }} KB
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-2 shrink-0">
                                <x-btn-primary href="{{ route('siswa.modul.baca', $modul) }}">
                                    📖 Baca
                                </x-btn-primary>
                                <x-btn-secondary href="{{ route('siswa.modul.unduh', $modul) }}">
                                    ⬇ Unduh
                                </x-btn-secondary>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
