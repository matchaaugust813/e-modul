@props(['type' => 'button'])

<button type="{{ $type }}"
        {{ $attributes->merge(['class' => 'inline-flex items-center px-5 py-2.5 bg-rose-50/80 dark:bg-rose-950/40 border border-rose-200/70 dark:border-rose-800/60 rounded-2xl font-medium text-sm text-rose-600 dark:text-rose-300 hover:bg-rose-100/80 dark:hover:bg-rose-900/50 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-rose-300 dark:focus:ring-rose-400 focus:ring-offset-2 dark:focus:ring-offset-slate-900 active:translate-y-0 shadow-sm transition duration-300 ease-out']) }}>
    {{ $slot }}
</button>
