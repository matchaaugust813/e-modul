<x-app-layout>
    @section('title', 'Baca: ' . $modul->judul)
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div class="flex items-center gap-2 text-sm flex-wrap text-slate-700 dark:text-slate-300">
                <a href="{{ route('siswa.kelas.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium transition duration-300">Kelas</a>
                <span class="text-slate-400 dark:text-slate-600">/</span>
                <a href="{{ route('siswa.mapel.index', $modul->mataPelajaran->kelas) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium transition duration-300">
                    {{ $modul->mataPelajaran->kelas->label }}
                </a>
                <span class="text-slate-400 dark:text-slate-600">/</span>
                <a href="{{ route('siswa.modul.index', $modul->mataPelajaran) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium transition duration-300">
                    {{ $modul->mataPelajaran->nama }}
                </a>
                <span class="text-slate-400 dark:text-slate-600">/</span>
                <span class="font-semibold text-slate-800 dark:text-slate-100 text-base">{{ $modul->judul }}</span>
            </div>
            <x-btn-secondary href="{{ route('siswa.modul.unduh', $modul) }}">
                <x-icon name="unduh" class="w-4 h-4 inline mr-1" />
                Unduh PDF
            </x-btn-secondary>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 dark:bg-slate-900/90 border border-slate-200/80 dark:border-white/10 rounded-3xl shadow-sm dark:shadow-none overflow-hidden">
                <iframe
                    src="{{ route('siswa.modul.stream', $modul) }}"
                    class="w-full"
                    style="height: 85vh; border: none;"
                    title="{{ $modul->judul }}"
                >
                    <p class="p-6 text-slate-500 dark:text-slate-400">
                        Peramban Anda tidak mendukung tampilan PDF bawaan.
                        Silakan <a href="{{ route('siswa.modul.unduh', $modul) }}" class="text-indigo-600 dark:text-indigo-400 underline">unduh PDF</a>.
                    </p>
                </iframe>
            </div>
        </div>
    </div>
</x-app-layout>
