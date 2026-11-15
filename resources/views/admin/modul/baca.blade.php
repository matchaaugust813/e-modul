<x-app-layout>
    @section('title', 'Tinjau Modul: ' . $modul->judul)
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div class="flex items-center gap-3">
                <x-btn-secondary href="{{ route('admin.modul.index') }}">
                    <x-icon name="panah-kiri" class="w-4 h-4 inline mr-1" />
                    Kembali
                </x-btn-secondary>
                <div>
                    <h2 class="font-semibold text-lg text-slate-800 dark:text-slate-100 leading-tight">{{ $modul->judul }}</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400">
                        {{ $modul->mataPelajaran->kelas->label ?? '-' }} &bull; {{ $modul->mataPelajaran->nama ?? '-' }} &bull; Guru: {{ $modul->guru->name ?? '-' }}
                    </p>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.modul.destroy', $modul) }}"
                  onsubmit="return confirm('Hapus modul ini dan berkas PDF-nya secara permanen?')">
                @csrf
                @method('DELETE')
                <x-btn-danger type="submit">Hapus Modul</x-btn-danger>
            </form>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 dark:bg-slate-900/90 border border-slate-200/80 dark:border-white/10 rounded-3xl shadow-sm dark:shadow-none overflow-hidden">
                <iframe
                    src="{{ route('admin.modul.stream', $modul) }}"
                    class="w-full"
                    style="height: 85vh; border: none;"
                    title="{{ $modul->judul }}"
                >
                    <p class="p-6 text-slate-500 dark:text-slate-400">
                        Peramban Anda tidak mendukung penampil PDF bawaan.
                    </p>
                </iframe>
            </div>
        </div>
    </div>
</x-app-layout>
