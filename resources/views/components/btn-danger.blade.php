@props(['type' => 'button'])

<button type="{{ $type }}"
        {{ $attributes->merge(['class' => 'inline-flex items-center px-5 py-2.5 bg-rose-50/80 border border-rose-200/70 rounded-2xl font-medium text-sm text-rose-600 hover:bg-rose-100/80 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-rose-300 focus:ring-offset-2 active:translate-y-0 shadow-sm transition duration-300 ease-out']) }}>
    {{ $slot }}
</button>
