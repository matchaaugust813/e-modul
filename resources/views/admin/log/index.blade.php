<x-app-layout>
    @section('title', 'Log Aktivitas Sistem')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-100 leading-tight">Riwayat Log Aktivitas</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            {{-- Filter Aksi --}}
            <form method="GET" action="{{ route('admin.log.index') }}" class="bg-white/80 dark:bg-slate-900/80 border border-slate-200/80 dark:border-slate-800 p-4 rounded-3xl shadow-sm dark:shadow-none flex flex-wrap gap-3 items-center">
                <div>
                    <select name="aksi" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm text-sm text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-400">
                        <option value="">Semua Aksi</option>
                        @foreach($aksiList as $a)
                            <option value="{{ $a }}" {{ $aksi === $a ? 'selected' : '' }}>
                                {{ ucfirst($a) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2">
                    <x-btn-primary type="submit">Filter</x-btn-primary>
                    @if($aksi)
                        <x-btn-secondary href="{{ route('admin.log.index') }}">Reset</x-btn-secondary>
                    @endif
                </div>
            </form>

            <x-card :padding="false">
                <x-table :headers="['Waktu', 'Aksi', 'Pelaku', 'Keterangan', 'Alamat IP']">
                    @forelse($logs as $log)
                        <tr class="hover:bg-slate-50/60 dark:hover:bg-slate-800/40 transition duration-150">
                            <td class="px-6 py-4 text-xs text-slate-500 dark:text-slate-400 whitespace-nowrap">
                                {{ $log->created_at ? $log->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $badgeClass = match($log->aksi) {
                                        'login admin berhasil' => 'bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800/60',
                                        'login admin gagal'    => 'bg-rose-50 dark:bg-rose-950/40 text-rose-700 dark:text-rose-300 border-rose-200 dark:border-rose-800/60',
                                        'setujui'              => 'bg-sky-50 dark:bg-sky-950/40 text-sky-700 dark:text-sky-300 border-sky-200 dark:border-sky-800/60',
                                        'tolak'                => 'bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-amber-300 border-amber-200 dark:border-amber-800/60',
                                        'hapus akun', 'hapus modul' => 'bg-rose-50 dark:bg-rose-950/40 text-rose-700 dark:text-rose-300 border-rose-200 dark:border-rose-800/60',
                                        'pulihkan akun'        => 'bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800/60',
                                        default                => 'bg-slate-50 dark:bg-slate-800 text-slate-700 dark:text-slate-200 border-slate-200 dark:border-slate-700',
                                    };
                                @endphp
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full border {{ $badgeClass }}">
                                    {{ ucfirst($log->aksi) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-200">
                                @if($log->user)
                                    <div>{{ $log->user->name }}</div>
                                    <div class="text-xs text-slate-400 dark:text-slate-500">{{ $log->user->email }}</div>
                                @else
                                    <span class="text-slate-400 dark:text-slate-500 italic">Sistem / Tamu</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-300">
                                {{ $log->keterangan ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-xs font-mono text-slate-500 dark:text-slate-400 whitespace-nowrap">
                                {{ $log->ip }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-slate-500 dark:text-slate-400 text-sm">
                                Belum ada catatan aktivitas.
                            </td>
                        </tr>
                    @endforelse
                </x-table>

                @if($logs->hasPages())
                    <div class="p-6 border-t border-slate-100 dark:border-white/10">
                        {{ $logs->links() }}
                    </div>
                @endif
            </x-card>

        </div>
    </div>
</x-app-layout>
