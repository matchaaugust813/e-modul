<x-app-layout>
    @section('title', 'Pilih Kelas')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">Pilih Kelas</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            @php
            $jenjangConfig = [
                'SD'  => [
                    'label'    => 'Sekolah Dasar (SD)',
                    'badgeBg'  => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                    'iconBg'   => 'bg-emerald-100 text-emerald-700',
                    'card'     => 'bg-white/80 border-emerald-100 shadow-sm hover:shadow-md',
                    'heading'  => 'text-emerald-800',
                ],
                'SMP' => [
                    'label'    => 'Sekolah Menengah Pertama (SMP)',
                    'badgeBg'  => 'bg-sky-50 text-sky-700 border-sky-200',
                    'iconBg'   => 'bg-sky-100 text-sky-700',
                    'card'     => 'bg-white/80 border-sky-100 shadow-sm hover:shadow-md',
                    'heading'  => 'text-sky-800',
                ],
                'SMA' => [
                    'label'    => 'Sekolah Menengah Atas (SMA)',
                    'badgeBg'  => 'bg-violet-50 text-violet-700 border-violet-200',
                    'iconBg'   => 'bg-violet-100 text-violet-700',
                    'card'     => 'bg-white/80 border-violet-100 shadow-sm hover:shadow-md',
                    'heading'  => 'text-violet-800',
                ],
            ];
            @endphp

            @foreach ($jenjangConfig as $jenjang => $cfg)
                @if(isset($kelasList[$jenjang]))
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-lg {{ $cfg['iconBg'] }}">
                                <x-icon name="buku" class="w-3.5 h-3.5" />
                            </span>
                            <h3 class="text-sm font-semibold {{ $cfg['heading'] }} uppercase tracking-wide">
                                {{ $cfg['label'] }}
                            </h3>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach ($kelasList[$jenjang] as $kelas)
                                <a href="{{ route('siswa.mapel.index', $kelas) }}"
                                   class="stagger-item flex flex-col items-center justify-center {{ $cfg['card'] }} border rounded-3xl hover:-translate-y-1 transition duration-300 ease-out p-6 text-center group">
                                    <div class="w-12 h-12 rounded-2xl {{ $cfg['iconBg'] }} flex items-center justify-center mb-3 group-hover:scale-105 transition duration-300">
                                        <x-icon name="buku" class="w-6 h-6" />
                                    </div>
                                    <span class="font-semibold text-slate-800 group-hover:text-indigo-600 transition duration-300">
                                        Kelas {{ $kelas->nomor }}
                                    </span>
                                    <span class="text-xs px-2.5 py-0.5 mt-2 rounded-full border {{ $cfg['badgeBg'] }}">
                                        {{ $kelas->jenjang }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    </div>
</x-app-layout>
