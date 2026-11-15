@props(['type' => 'button'])

@if($attributes->has('href'))
    <a {{ $attributes->merge(['class' => 'inline-flex items-center px-5 py-2.5 bg-white/50 dark:bg-slate-800/70 border border-white/70 dark:border-white/10 rounded-2xl font-medium text-sm text-slate-600 dark:text-slate-200 hover:bg-white/80 dark:hover:bg-slate-700/70 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-300 dark:focus:ring-indigo-400 focus:ring-offset-2 dark:focus:ring-offset-slate-900 active:translate-y-0 shadow-sm dark:shadow-none backdrop-blur transition duration-300 ease-out']) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}"
            {{ $attributes->merge(['class' => 'inline-flex items-center px-5 py-2.5 bg-white/50 dark:bg-slate-800/70 border border-white/70 dark:border-white/10 rounded-2xl font-medium text-sm text-slate-600 dark:text-slate-200 hover:bg-white/80 dark:hover:bg-slate-700/70 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-300 dark:focus:ring-indigo-400 focus:ring-offset-2 dark:focus:ring-offset-slate-900 active:translate-y-0 shadow-sm dark:shadow-none backdrop-blur transition duration-300 ease-out']) }}>
        {{ $slot }}
    </button>
@endif
