<x-app-layout>
    @section('title', 'Dashboard Superadmin')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-100 leading-tight">Dashboard Kepala Sekolah</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <x-alert type="success" message="{{ session('success') }}" />
            @endif
            @if(session('error'))
                <x-alert type="error" message="{{ session('error') }}" />
            @endif

            {{-- Kartu Ringkasan Statistik Utama --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                {{-- Siswa Aktif --}}
                <x-card class="stagger-item">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-sky-100 dark:bg-sky-950/40 rounded-2xl text-sky-700 dark:text-sky-300">
                            <x-icon name="siswa" class="w-7 h-7" />
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Siswa Aktif</p>
                            <p class="text-2xl font-bold text-slate-800 dark:text-slate-100 mt-0.5">{{ $siswaAktif }}</p>
                        </div>
                    </div>
                </x-card>

                {{-- Guru Aktif --}}
                <x-card class="stagger-item">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-violet-100 dark:bg-violet-950/40 rounded-2xl text-violet-700 dark:text-violet-300">
                            <x-icon name="guru" class="w-7 h-7" />
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Guru Aktif</p>
                            <p class="text-2xl font-bold text-slate-800 dark:text-slate-100 mt-0.5">{{ $guruAktif }}</p>
                        </div>
                    </div>
                </x-card>

                {{-- Akun Menunggu Persetujuan --}}
                <x-card class="stagger-item">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-amber-100 dark:bg-amber-950/40 rounded-2xl text-amber-700 dark:text-amber-300">
                                <x-icon name="jam" class="w-7 h-7" />
                            </div>
                            <div>
                                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Menunggu Persetujuan</p>
                                <p class="text-2xl font-bold text-amber-700 dark:text-amber-300 mt-0.5">{{ $akunPending }}</p>
                            </div>
                        </div>
                        @if($akunPending > 0)
                            <a href="{{ route('admin.persetujuan.index') }}" class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">
                                Tinjau
                            </a>
                        @endif
                    </div>
                </x-card>

                {{-- Total Modul --}}
                <x-card class="stagger-item">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-indigo-100 dark:bg-indigo-950/50 rounded-2xl text-indigo-700 dark:text-indigo-300">
                            <x-icon name="dokumen" class="w-7 h-7" />
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Modul</p>
                            <p class="text-2xl font-bold text-slate-800 dark:text-slate-100 mt-0.5">{{ $totalModul }}</p>
                        </div>
                    </div>
                </x-card>

                {{-- Total Ukuran Modul --}}
                <x-card class="stagger-item">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-emerald-100 dark:bg-emerald-950/50 rounded-2xl text-emerald-700 dark:text-emerald-300">
                            <x-icon name="folder" class="w-7 h-7" />
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Penyimpanan Berkas</p>
                            <p class="text-2xl font-bold text-slate-800 dark:text-slate-100 mt-0.5">{{ format_ukuran($totalUkuran) }}</p>
                        </div>
                    </div>
                </x-card>

                {{-- Modul per Jenjang --}}
                <x-card class="stagger-item">
                    <div>
                        <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Modul per Jenjang</p>
                        <div class="flex items-center gap-3 text-sm">
                            <span class="inline-flex items-center gap-1 text-emerald-700 dark:text-emerald-300 font-medium">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> SD: {{ $modulPerJenjang['SD'] ?? 0 }}
                            </span>
                            <span class="inline-flex items-center gap-1 text-sky-700 dark:text-sky-300 font-medium">
                                <span class="w-2 h-2 rounded-full bg-sky-500"></span> SMP: {{ $modulPerJenjang['SMP'] ?? 0 }}
                            </span>
                            <span class="inline-flex items-center gap-1 text-violet-700 dark:text-violet-300 font-medium">
                                <span class="w-2 h-2 rounded-full bg-violet-500"></span> SMA: {{ $modulPerJenjang['SMA'] ?? 0 }}
                            </span>
                        </div>
                    </div>
                </x-card>
            </div>

            {{-- 5 Pendaftar Pending Terbaru --}}
            <x-card title="Pendaftaran Terbaru Menunggu Persetujuan">
                <x-table :headers="['Nama Lengkap', 'Email', 'Peran', 'Keterangan', 'Aksi']">
                    @forelse($pendaftarTerbaru as $user)
                        <tr class="hover:bg-slate-50/60 dark:hover:bg-slate-800/40 transition duration-150">
                            <td class="px-6 py-4 font-medium text-slate-800 dark:text-slate-100">
                                {{ $user->name }}
                            </td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                @if($user->role === 'guru')
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-violet-100 dark:bg-violet-950/40 text-violet-700 dark:text-violet-300 border border-violet-200/60 dark:border-violet-800/60">Guru</span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-sky-100 dark:bg-sky-950/40 text-sky-700 dark:text-sky-300 border border-sky-200/60 dark:border-sky-800/60">Siswa</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-500 dark:text-slate-400">
                                @if($user->role === 'siswa')
                                    Kelas: {{ $user->kelas ? $user->kelas->label : '-' }} &bull; NIS: {{ $user->nis ?? '-' }}
                                @else
                                    Mapel: {{ $user->mata_pelajaran_diampu ?? '-' }} &bull; NIP: {{ $user->nip ?? '-' }}
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <form method="POST" action="{{ route('admin.persetujuan.setujui', $user) }}"
                                          onsubmit="return confirm('Setujui pendaftaran akun ini?')">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-emerald-600 hover:bg-emerald-700 text-white shadow-sm transition">
                                            Setujui
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.persetujuan.tolak', $user) }}"
                                          onsubmit="return confirm('Tolak pendaftaran akun ini?')">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-rose-600 hover:bg-rose-700 text-white shadow-sm transition">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400 text-sm">
                                Tidak ada pendaftaran akun yang menunggu persetujuan.
                            </td>
                        </tr>
                    @endforelse
                </x-table>

                @if($pendaftarTerbaru->isNotEmpty())
                    <div class="mt-4 pt-3 border-t border-slate-100 dark:border-white/10 text-right">
                        <a href="{{ route('admin.persetujuan.index') }}" class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">
                            Lihat Semua Pendaftar Pending &rarr;
                        </a>
                    </div>
                @endif
            </x-card>

        </div>
    </div>
</x-app-layout>
