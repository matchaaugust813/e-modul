@props(['title' => null, 'padding' => true])

<div {{ $attributes->merge(['class' => 'bg-white/50 dark:bg-slate-900/60 backdrop-blur-2xl border border-white/60 dark:border-white/10 shadow-lg shadow-indigo-200/20 dark:shadow-none rounded-3xl supports-[backdrop-filter]:bg-white/50 dark:supports-[backdrop-filter]:bg-slate-900/60']) }}>
    @if($title)
        <div class="px-6 py-4 border-b border-white/40 dark:border-white/10">
            <h3 class="font-semibold text-slate-800 dark:text-slate-100">{{ $title }}</h3>
        </div>
    @endif
    <div @class(['p-6' => $padding])>
        {{ $slot }}
    </div>
</div>
