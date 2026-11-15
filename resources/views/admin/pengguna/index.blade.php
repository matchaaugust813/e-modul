<x-app-layout>
    @section('title', 'Kelola Pengguna')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-100 leading-tight">Kelola Pengguna</h2>
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
            <form method="GET" action="{{ route('admin.pengguna.index') }}" class="bg-white/80 dark:bg-slate-900/80 border border-slate-200/80 dark:border-slate-800 p-4 rounded-3xl shadow-sm dark:shadow-none flex flex-wrap gap-3 items-center">
                <div class="flex-1 min-w-[200px]">
                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Cari nama atau email..."
                        aria-label="Cari nama atau email"
                        class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
                    >
                </div>

                {{-- Filter Peran --}}
                <div>
                    <select name="role" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm text-sm text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-400">
                        <option value="">Semua Peran</option>
                        <option value="guru" {{ $role === 'guru' ? 'selected' : '' }}>Guru</option>
                        <option value="siswa" {{ $role === 'siswa' ? 'selected' : '' }}>Siswa</option>
                        <option value="superadmin" {{ $role === 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                    </select>
                </div>

                {{-- Filter Status --}}
                <div>
                    <select name="status" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm text-sm text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-400">
                        <option value="">Semua Status</option>
                        <option value="active" {{ $status === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Menunggu (Pending)</option>
                        <option value="rejected" {{ $status === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        <option value="dihapus" {{ $status === 'dihapus' ? 'selected' : '' }}>Dinonaktifkan (Dihapus)</option>
                    </select>
                </div>

                <div class="flex gap-2">
                    <x-btn-primary type="submit">Filter</x-btn-primary>
                    @if($search || $role || $status)
                        <x-btn-secondary href="{{ route('admin.pengguna.index') }}">Reset</x-btn-secondary>
                    @endif
                </div>
            </form>

            <x-card :padding="false">
                <x-table :headers="['Nama Lengkap', 'Email', 'Peran', 'Status', 'Terdaftar', 'Aksi']">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/60 dark:hover:bg-slate-800/40 transition duration-150 {{ $user->trashed() ? 'opacity-60 bg-slate-50/40 dark:bg-slate-950/40' : '' }}">
                            <td class="px-6 py-4 font-medium text-slate-800 dark:text-slate-100">
                                <div>{{ $user->name }}</div>
                                @if($user->role === 'siswa' && $user->nis)
                                    <span class="text-xs text-slate-500 dark:text-slate-400">NIS: {{ $user->nis }}</span>
                                @elseif($user->role === 'guru' && $user->nip)
                                    <span class="text-xs text-slate-500 dark:text-slate-400">NIP: {{ $user->nip }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-300 text-sm">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                @if($user->role === 'superadmin')
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-indigo-100 dark:bg-indigo-950/40 text-indigo-700 dark:text-indigo-300 border border-indigo-200/60 dark:border-indigo-800/60">Superadmin</span>
                                @elseif($user->role === 'guru')
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-violet-100 dark:bg-violet-950/40 text-violet-700 dark:text-violet-300 border border-violet-200/60 dark:border-violet-800/60">Guru</span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-sky-100 dark:bg-sky-950/40 text-sky-700 dark:text-sky-300 border border-sky-200/60 dark:border-sky-800/60">Siswa</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($user->trashed())
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-rose-50 dark:bg-rose-950/40 text-rose-700 dark:text-rose-300 border border-rose-200 dark:border-rose-800/60">
                                        Dihapus
                                    </span>
                                @elseif($user->status === 'active')
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800/60">
                                        Aktif
                                    </span>
                                @elseif($user->status === 'pending')
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-amber-300 border border-amber-200 dark:border-amber-800/60">
                                        Pending
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-500 dark:text-slate-400 whitespace-nowrap">
                                {{ format_tanggal($user->created_at) }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1.5 flex-wrap">
                                    @if($user->trashed())
                                        <form method="POST" action="{{ route('admin.pengguna.pulihkan', $user->id) }}"
                                              onsubmit="return confirm('Pulihkan akun {{ $user->name }}?')">
                                            @csrf
                                            <button type="submit" class="px-2.5 py-1 rounded-xl text-xs font-medium bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800/60 hover:bg-emerald-100 dark:hover:bg-emerald-900/50 transition">
                                                Pulihkan
                                            </button>
                                        </form>
                                    @else
                                        @if(!$user->isSuperAdmin())
                                            @if($user->status !== 'active')
                                                <form method="POST" action="{{ route('admin.pengguna.setujui', $user) }}"
                                                      onsubmit="return confirm('Setujui akun {{ $user->name }}?')">
                                                    @csrf
                                                    <button type="submit" class="px-2.5 py-1 rounded-xl text-xs font-medium bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800/60 hover:bg-emerald-100 dark:hover:bg-emerald-900/50 transition">
                                                        Setujui
                                                    </button>
                                                </form>
                                            @endif
                                            @if($user->status !== 'rejected')
                                                <form method="POST" action="{{ route('admin.pengguna.tolak', $user) }}"
                                                      onsubmit="return confirm('Tolak akun {{ $user->name }}?')">
                                                    @csrf
                                                    <button type="submit" class="px-2.5 py-1 rounded-xl text-xs font-medium bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-amber-300 border border-amber-200 dark:border-amber-800/60 hover:bg-amber-100 dark:hover:bg-amber-900/50 transition">
                                                        Tolak
                                                    </button>
                                                </form>
                                            @endif
                                            @if($user->id !== auth()->id())
                                                <form method="POST" action="{{ route('admin.pengguna.destroy', $user) }}"
                                                      onsubmit="return confirm('Hapus/nonaktifkan akun {{ $user->name }}? Modul miliknya akan tetap tersimpan.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-2.5 py-1 rounded-xl text-xs font-medium bg-rose-50 dark:bg-rose-950/40 text-rose-700 dark:text-rose-300 border border-rose-200 dark:border-rose-800/60 hover:bg-rose-100 dark:hover:bg-rose-900/50 transition">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            <span class="text-xs text-slate-400 dark:text-slate-500 italic">Akun Utama</span>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-slate-500 dark:text-slate-400 text-sm">
                                Tidak ada data pengguna yang sesuai.
                            </td>
                        </tr>
                    @endforelse
                </x-table>

                @if($users->hasPages())
                    <div class="p-6 border-t border-slate-100 dark:border-white/10">
                        {{ $users->links() }}
                    </div>
                @endif
            </x-card>

        </div>
    </div>
</x-app-layout>
