<x-app-layout>
    @section('title', 'Persetujuan Pendaftaran')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">Persetujuan Pendaftaran</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if(session('success'))
                <x-alert type="success" message="{{ session('success') }}" />
            @endif
            @if(session('error'))
                <x-alert type="error" message="{{ session('error') }}" />
            @endif

            {{-- Filter Peran --}}
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.persetujuan.index') }}"
                   class="px-4 py-2 rounded-2xl text-sm font-medium transition {{ empty($role) ? 'bg-indigo-600 text-white shadow-sm' : 'bg-white/80 border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
                    Semua
                </a>
                <a href="{{ route('admin.persetujuan.index', ['role' => 'guru']) }}"
                   class="px-4 py-2 rounded-2xl text-sm font-medium transition {{ $role === 'guru' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-white/80 border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
                    Khusus Guru
                </a>
                <a href="{{ route('admin.persetujuan.index', ['role' => 'siswa']) }}"
                   class="px-4 py-2 rounded-2xl text-sm font-medium transition {{ $role === 'siswa' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-white/80 border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
                    Khusus Siswa
                </a>
            </div>

            <x-card :padding="false">
                <x-table :headers="['Nama Lengkap', 'Email', 'Peran', 'Data Tambahan', 'Tanggal Daftar', 'Aksi']">
                    @forelse($pendingUsers as $user)
                        <tr class="hover:bg-slate-50/60 transition duration-150">
                            <td class="px-6 py-4 font-medium text-slate-800">
                                {{ $user->name }}
                            </td>
                            <td class="px-6 py-4 text-slate-600 text-sm">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                @if($user->role === 'guru')
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-violet-100 text-violet-700">Guru</span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-sky-100 text-sky-700">Siswa</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-600">
                                @if($user->role === 'siswa')
                                    <div>Kelas: <span class="font-medium text-slate-800">{{ $user->kelas ? $user->kelas->label : '-' }}</span></div>
                                    <div>NIS: <span class="font-medium text-slate-800">{{ $user->nis ?? '-' }}</span></div>
                                @else
                                    <div>Mapel: <span class="font-medium text-slate-800">{{ $user->mata_pelajaran_diampu ?? '-' }}</span></div>
                                    <div>NIP: <span class="font-medium text-slate-800">{{ $user->nip ?? '-' }}</span></div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-500 whitespace-nowrap">
                                {{ format_tanggal($user->created_at) }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <form method="POST" action="{{ route('admin.persetujuan.setujui', $user) }}"
                                          onsubmit="return confirm('Setujui pendaftaran akun {{ $user->name }}?')">
                                        @csrf
                                        <button type="submit" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-emerald-600 hover:bg-emerald-700 text-white shadow-sm transition">
                                            Setujui
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.persetujuan.tolak', $user) }}"
                                          onsubmit="return confirm('Tolak pendaftaran akun {{ $user->name }}?')">
                                        @csrf
                                        <button type="submit" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-rose-600 hover:bg-rose-700 text-white shadow-sm transition">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-slate-500 text-sm">
                                Tidak ada akun yang menunggu persetujuan.
                            </td>
                        </tr>
                    @endforelse
                </x-table>

                @if($pendingUsers->hasPages())
                    <div class="p-6 border-t border-slate-100">
                        {{ $pendingUsers->links() }}
                    </div>
                @endif
            </x-card>

        </div>
    </div>
</x-app-layout>
