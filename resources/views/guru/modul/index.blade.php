<x-app-layout>
    @section('title', 'Daftar Modul')
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-100 leading-tight">Daftar Modul</h2>
            <x-btn-primary :href="route('guru.modul.create')">
                <x-icon name="tambah" class="w-4 h-4 inline-block mr-1" />
                Tambah Modul
            </x-btn-primary>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if(session('success'))
                <x-alert type="success" message="{{ session('success') }}" />
            @endif

            {{-- Form Pencarian --}}
            <form method="GET" action="{{ route('guru.modul.index') }}" class="flex gap-2">
                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Cari judul modul..."
                    aria-label="Cari judul modul"
                    class="bg-white/80 dark:bg-slate-900/80 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm text-sm flex-1 text-slate-700 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition duration-300 ease-out"
                >
                <x-btn-primary type="submit">Cari</x-btn-primary>
                @if($search)
                    <x-btn-secondary href="{{ route('guru.modul.index') }}">Reset</x-btn-secondary>
                @endif
            </form>

            <x-card :padding="false">
                <x-table :headers="['Judul', 'Mata Pelajaran', 'Kelas', 'Ukuran', 'Aksi']">
                    @forelse($moduls as $modul)
                        <tr class="hover:bg-slate-50/60 dark:hover:bg-slate-800/40 transition duration-100">
                            <td class="px-6 py-4 font-medium text-slate-800 dark:text-slate-100">
                                {{ $modul->judul }}
                            </td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                                {{ $modul->mataPelajaran->nama }}
                            </td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                                {{ $modul->mataPelajaran->kelas->label }}
                            </td>
                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400 text-xs">
                                {{ format_ukuran($modul->ukuran) }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <x-btn-secondary href="{{ route('guru.modul.edit', $modul) }}">
                                        Ubah
                                    </x-btn-secondary>
                                    <form method="POST" action="{{ route('guru.modul.destroy', $modul) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus modul ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <x-btn-danger type="submit">Hapus</x-btn-danger>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-slate-500 dark:text-slate-400">
                                Belum ada modul yang diunggah. <a href="{{ route('guru.modul.create') }}" class="text-indigo-600 dark:text-indigo-400 font-medium hover:underline">Tambah modul baru</a>.
                            </td>
                        </tr>
                    @endforelse
                </x-table>

                @if($moduls->hasPages())
                    <div class="px-6 py-4 border-t border-white/40 dark:border-white/10">
                        {{ $moduls->links() }}
                    </div>
                @endif
            </x-card>
        </div>
    </div>
</x-app-layout>
