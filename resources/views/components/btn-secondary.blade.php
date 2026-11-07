@props(['type' => 'button'])

@if($attributes->has('href'))
    <a {{ $attributes->merge(['class' => 'inline-flex items-center px-5 py-2.5 bg-white/50 border border-white/70 rounded-2xl font-medium text-sm text-slate-600 hover:bg-white/80 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:ring-offset-2 active:translate-y-0 shadow-sm backdrop-blur transition duration-300 ease-out']) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}"
            {{ $attributes->merge(['class' => 'inline-flex items-center px-5 py-2.5 bg-white/50 border border-white/70 rounded-2xl font-medium text-sm text-slate-600 hover:bg-white/80 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:ring-offset-2 active:translate-y-0 shadow-sm backdrop-blur transition duration-300 ease-out']) }}>
        {{ $slot }}
    </button>
@endif
