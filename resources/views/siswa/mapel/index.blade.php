<x-app-layout>
    @section('title', 'Mata Pelajaran ' . $kelas->label)
    <x-slot name="header">
        <div class="flex items-center gap-2 text-slate-700 flex-wrap text-sm">
            <a href="{{ route('siswa.kelas.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium transition duration-300">Kelas</a>
            <span class="text-slate-400">/</span>
            <span class="font-semibold text-slate-800">{{ $kelas->label }}</span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if ($mataPelajarans->isEmpty())
                <x-card>
                    <p class="text-slate-500 text-center py-6">Belum ada mata pelajaran untuk kelas ini.</p>
                </x-card>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach ($mataPelajarans as $mapel)
                        <a href="{{ route('siswa.modul.index', $mapel) }}"
                           class="stagger-item flex items-center gap-4 bg-white/80 border border-slate-200/80 rounded-3xl shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-300 ease-out p-5 group">
                            <div class="flex-shrink-0 w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center">
                                <x-icon name="buku" class="w-6 h-6" />
                            </div>
                            <div>
                                <p class="font-semibold text-slate-800 group-hover:text-indigo-600 transition duration-300">{{ $mapel->nama }}</p>
                                <p class="text-xs text-slate-500 mt-0.5">{{ $kelas->label }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
