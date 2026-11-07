<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">Daftar Modul</h2>
            <x-btn-primary :href="route('guru.modul.create')">+ Tambah Modul</x-btn-primary>
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
                    class="bg-white/50 border border-white/70 rounded-2xl shadow-sm text-sm flex-1 text-slate-700 placeholder-slate-400 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300 backdrop-blur transition duration-300 ease-out"
                >
                <x-btn-primary type="submit">Cari</x-btn-primary>
                @if($search)
                    <x-btn-secondary href="{{ route('guru.modul.index') }}">Reset</x-btn-secondary>
                @endif
            </form>

            <x-card :padding="false">
                <x-table :headers="['Judul', 'Mata Pelajaran', 'Kelas', 'Ukuran', 'Aksi']">
                    @forelse($moduls as $modul)
                        <tr class="hover:bg-white/40 transition duration-100">
                            <td class="px-6 py-4 font-medium text-slate-800">
                                {{ $modul->judul }}
                            </td>
                            <td class="px-6 py-4 text-slate-600">
                                {{ $modul->mataPelajaran->nama }}
                            </td>
                            <td class="px-6 py-4 text-slate-600">
                                {{ $modul->mataPelajaran->kelas->label }}
                            </td>
                            <td class="px-6 py-4 text-slate-500 text-xs">
                                {{ $modul->ukuran ? number_format($modul->ukuran / 1024, 1) . ' KB' : '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <x-btn-secondary href="{{ route('guru.modul.edit', $modul) }}">
                                        Edit
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
                            <td colspan="5" class="px-6 py-10 text-center text-slate-400">
                                Belum ada modul. <a href="{{ route('guru.modul.create') }}" class="text-indigo-600 hover:underline">Tambah sekarang</a>.
                            </td>
                        </tr>
                    @endforelse
                </x-table>

                @if($moduls->hasPages())
                    <div class="px-6 py-4 border-t border-white/40">
                        {{ $moduls->links() }}
                    </div>
                @endif
            </x-card>
        </div>
    </div>
</x-app-layout>
