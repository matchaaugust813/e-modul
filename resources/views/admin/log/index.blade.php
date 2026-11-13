<x-app-layout>
    @section('title', 'Log Aktivitas Sistem')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">Riwayat Log Aktivitas</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            {{-- Filter Aksi --}}
            <form method="GET" action="{{ route('admin.log.index') }}" class="bg-white/80 border border-slate-200/80 p-4 rounded-3xl shadow-sm flex flex-wrap gap-3 items-center">
                <div>
                    <select name="aksi" class="bg-white border border-slate-200 rounded-2xl shadow-sm text-sm text-slate-700 focus:ring-2 focus:ring-indigo-400">
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
                        <tr class="hover:bg-slate-50/60 transition duration-150">
                            <td class="px-6 py-4 text-xs text-slate-500 whitespace-nowrap">
                                {{ $log->created_at ? $log->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $badgeClass = match($log->aksi) {
                                        'login admin berhasil' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        'login admin gagal'    => 'bg-rose-50 text-rose-700 border-rose-200',
                                        'setujui'              => 'bg-sky-50 text-sky-700 border-sky-200',
                                        'tolak'                => 'bg-amber-50 text-amber-700 border-amber-200',
                                        'hapus akun', 'hapus modul' => 'bg-rose-50 text-rose-700 border-rose-200',
                                        'pulihkan akun'        => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        default                => 'bg-slate-50 text-slate-700 border-slate-200',
                                    };
                                @endphp
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full border {{ $badgeClass }}">
                                    {{ ucfirst($log->aksi) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-700">
                                @if($log->user)
                                    <div>{{ $log->user->name }}</div>
                                    <div class="text-xs text-slate-400">{{ $log->user->email }}</div>
                                @else
                                    <span class="text-slate-400 italic">Sistem / Tamu</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ $log->keterangan ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-xs font-mono text-slate-500 whitespace-nowrap">
                                {{ $log->ip }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-slate-500 text-sm">
                                Belum ada catatan aktivitas.
                            </td>
                        </tr>
                    @endforelse
                </x-table>

                @if($logs->hasPages())
                    <div class="p-6 border-t border-slate-100">
                        {{ $logs->links() }}
                    </div>
                @endif
            </x-card>

        </div>
    </div>
</x-app-layout>
