<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">Pilih Kelas</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            @php
            $jenjangConfig = [
                'SD'  => [
                    'label'    => 'Sekolah Dasar (SD)',
                    'emoji'    => '📗',
                    'card'     => 'bg-gradient-to-br from-emerald-100 to-emerald-50 border-emerald-200/60 shadow-emerald-200/40',
                    'hover'    => 'hover:bg-emerald-50/80',
                    'title'    => 'text-emerald-700',
                    'badge'    => 'text-emerald-500',
                    'heading'  => 'text-emerald-600',
                ],
                'SMP' => [
                    'label'    => 'Sekolah Menengah Pertama (SMP)',
                    'emoji'    => '📘',
                    'card'     => 'bg-gradient-to-br from-sky-100 to-sky-50 border-sky-200/60 shadow-sky-200/40',
                    'hover'    => 'hover:bg-sky-50/80',
                    'title'    => 'text-sky-700',
                    'badge'    => 'text-sky-500',
                    'heading'  => 'text-sky-600',
                ],
                'SMA' => [
                    'label'    => 'Sekolah Menengah Atas (SMA)',
                    'emoji'    => '📙',
                    'card'     => 'bg-gradient-to-br from-violet-100 to-violet-50 border-violet-200/60 shadow-violet-200/40',
                    'hover'    => 'hover:bg-violet-50/80',
                    'title'    => 'text-violet-700',
                    'badge'    => 'text-violet-500',
                    'heading'  => 'text-violet-600',
                ],
            ];
            @endphp

            @foreach ($jenjangConfig as $jenjang => $cfg)
                @if(isset($kelasList[$jenjang]))
                    <div>
                        <h3 class="text-sm font-semibold {{ $cfg['heading'] }} uppercase tracking-wide mb-4 flex items-center gap-2">
                            <span>{{ $cfg['emoji'] }}</span>
                            {{ $cfg['label'] }}
                        </h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach ($kelasList[$jenjang] as $kelas)
                                <a href="{{ route('siswa.mapel.index', $kelas) }}"
                                   class="stagger-item flex flex-col items-center justify-center {{ $cfg['card'] }} {{ $cfg['hover'] }} border backdrop-blur-xl rounded-3xl shadow-lg hover:shadow-xl hover:-translate-y-1.5 transition duration-300 ease-out p-6 text-center group">
                                    <span class="text-4xl mb-3">{{ $cfg['emoji'] }}</span>
                                    <span class="font-semibold text-slate-800 group-hover:{{ $cfg['title'] }} transition duration-300">
                                        Kelas {{ $kelas->nomor }}
                                    </span>
                                    <span class="text-xs {{ $cfg['badge'] }} mt-1">{{ $kelas->jenjang }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    </div>
</x-app-layout>
