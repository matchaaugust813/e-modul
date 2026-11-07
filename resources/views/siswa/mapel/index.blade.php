<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-slate-700 flex-wrap">
            <a href="{{ route('siswa.kelas.index') }}" class="text-indigo-500 hover:text-indigo-700 font-medium transition duration-300">Kelas</a>
            <span class="text-slate-300">/</span>
            <span class="font-semibold text-slate-800">{{ $kelas->label }}</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if ($mataPelajarans->isEmpty())
                <x-card>
                    <p class="text-slate-400 text-center">Belum ada mata pelajaran untuk kelas ini.</p>
                </x-card>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach ($mataPelajarans as $mapel)
                        <a href="{{ route('siswa.modul.index', $mapel) }}"
                           class="stagger-item flex items-center gap-4 bg-white/50 backdrop-blur-2xl border border-white/60 rounded-3xl shadow-lg shadow-indigo-200/20 hover:shadow-xl hover:bg-white/70 hover:-translate-y-1.5 transition duration-300 ease-out p-5 group">
                            <div class="flex-shrink-0 w-12 h-12 bg-indigo-100/70 rounded-2xl flex items-center justify-center text-2xl">📖</div>
                            <div>
                                <p class="font-semibold text-slate-800 group-hover:text-indigo-600 transition duration-300">{{ $mapel->nama }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $kelas->label }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
