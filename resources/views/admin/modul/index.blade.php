<x-app-layout>
    @section('title', 'Kelola Modul Pembelajaran')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">Kelola Semua Modul</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if(session('success'))
                <x-alert type="success" message="{{ session('success') }}" />
            @endif
            @if(session('error'))
                <x-alert type="error" message="{{ session('error') }}" />
            @endif

            {{-- Filter dan Pencarian --}}
            <form method="GET" action="{{ route('admin.modul.index') }}" class="bg-white/80 border border-slate-200/80 p-4 rounded-3xl shadow-sm flex flex-wrap gap-3 items-center">
                <div class="flex-1 min-w-[200px]">
                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Cari judul modul..."
                        aria-label="Cari judul modul"
                        class="w-full bg-white border border-slate-200 rounded-2xl shadow-sm text-sm text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
                    >
                </div>

                {{-- Filter Kelas --}}
                <div>
                    <select name="kelas_id" class="bg-white border border-slate-200 rounded-2xl shadow-sm text-sm text-slate-700 focus:ring-2 focus:ring-indigo-400">
                        <option value="">Semua Kelas</option>
                        @foreach($kelasList as $k)
                            <option value="{{ $k->id }}" {{ (string)$kelasId === (string)$k->id ? 'selected' : '' }}>
                                {{ $k->label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter Guru --}}
                <div>
                    <select name="guru_id" class="bg-white border border-slate-200 rounded-2xl shadow-sm text-sm text-slate-700 focus:ring-2 focus:ring-indigo-400">
                        <option value="">Semua Guru</option>
                        @foreach($guruList as $g)
                            <option value="{{ $g->id }}" {{ (string)$guruId === (string)$g->id ? 'selected' : '' }}>
                                {{ $g->name }} {{ $g->trashed() ? '(Non-aktif)' : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-2">
                    <x-btn-primary type="submit">Filter</x-btn-primary>
                    @if($search || $kelasId || $guruId)
                        <x-btn-secondary href="{{ route('admin.modul.index') }}">Reset</x-btn-secondary>
                    @endif
                </div>
            </form>

            <x-card :padding="false">
                <x-table :headers="['Judul Modul', 'Mata Pelajaran', 'Kelas', 'Guru Pengunggah', 'Ukuran', 'Tanggal', 'Aksi']">
                    @forelse($moduls as $modul)
                        <tr class="hover:bg-slate-50/60 transition duration-150">
                            <td class="px-6 py-4 font-medium text-slate-800">
                                <div>{{ $modul->judul }}</div>
                                @if($modul->deskripsi)
                                    <p class="text-xs text-slate-500 mt-0.5 line-clamp-1">{{ $modul->deskripsi }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-600 text-sm">
                                {{ $modul->mataPelajaran->nama ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-slate-600 text-sm whitespace-nowrap">
                                {{ $modul->mataPelajaran->kelas->label ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-700 whitespace-nowrap">
                                {{ $modul->guru->name ?? '-' }}
                                @if($modul->guru && $modul->guru->trashed())
                                    <span class="text-xs text-rose-500 italic">(Dihapus)</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-500 whitespace-nowrap">
                                {{ format_ukuran($modul->ukuran) }}
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-500 whitespace-nowrap">
                                {{ format_tanggal($modul->created_at) }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.modul.baca', $modul) }}"
                                       class="px-2.5 py-1 rounded-xl text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-200 hover:bg-indigo-100 transition">
                                        Lihat
                                    </a>
                                    <form method="POST" action="{{ route('admin.modul.destroy', $modul) }}"
                                          onsubmit="return confirm('Hapus modul {{ $modul->judul }}? Berkas file PDF juga akan terhapus secara permanen.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 rounded-xl text-xs font-medium bg-rose-50 text-rose-700 border border-rose-200 hover:bg-rose-100 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-slate-500 text-sm">
                                Tidak ada data modul yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </x-table>

                @if($moduls->hasPages())
                    <div class="p-6 border-t border-slate-100">
                        {{ $moduls->links() }}
                    </div>
                @endif
            </x-card>

        </div>
    </div>
</x-app-layout>
