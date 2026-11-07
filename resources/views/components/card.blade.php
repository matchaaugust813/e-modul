@props(['title' => null, 'padding' => true])

<div {{ $attributes->merge(['class' => 'bg-white/50 backdrop-blur-2xl border border-white/60 shadow-lg shadow-indigo-200/20 rounded-3xl supports-[backdrop-filter]:bg-white/50']) }}>
    @if($title)
        <div class="px-6 py-4 border-b border-white/40">
            <h3 class="font-semibold text-slate-800">{{ $title }}</h3>
        </div>
    @endif
    <div @class(['p-6' => $padding])>
        {{ $slot }}
    </div>
</div>
