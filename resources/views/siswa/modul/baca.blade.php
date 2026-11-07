<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div class="flex items-center gap-2 text-sm flex-wrap text-slate-600">
                <a href="{{ route('siswa.kelas.index') }}" class="text-indigo-500 hover:text-indigo-700 font-medium transition duration-300">Kelas</a>
                <span class="text-slate-300">/</span>
                <a href="{{ route('siswa.mapel.index', $modul->mataPelajaran->kelas) }}" class="text-indigo-500 hover:text-indigo-700 font-medium transition duration-300">
                    {{ $modul->mataPelajaran->kelas->label }}
                </a>
                <span class="text-slate-300">/</span>
                <a href="{{ route('siswa.modul.index', $modul->mataPelajaran) }}" class="text-indigo-500 hover:text-indigo-700 font-medium transition duration-300">
                    {{ $modul->mataPelajaran->nama }}
                </a>
                <span class="text-slate-300">/</span>
                <span class="font-semibold text-slate-800 text-base">{{ $modul->judul }}</span>
            </div>
            <x-btn-secondary href="{{ route('siswa.modul.unduh', $modul) }}">
                ⬇ Unduh PDF
            </x-btn-secondary>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/50 backdrop-blur-2xl border border-white/60 rounded-3xl shadow-xl shadow-indigo-200/20 overflow-hidden">
                <iframe
                    src="{{ route('siswa.modul.stream', $modul) }}"
                    class="w-full"
                    style="height: 85vh; border: none;"
                    title="{{ $modul->judul }}"
                >
                    <p class="p-6 text-slate-500">
                        Browser Anda tidak mendukung tampilan PDF bawaan.
                        Silakan <a href="{{ route('siswa.modul.unduh', $modul) }}" class="text-indigo-500 underline">unduh PDF</a>.
                    </p>
                </iframe>
            </div>
        </div>
    </div>
</x-app-layout>
