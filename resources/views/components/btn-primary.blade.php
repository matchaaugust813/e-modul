@props(['type' => 'button'])

@if($attributes->has('href'))
    <a {{ $attributes->merge(['class' => 'inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-400 to-violet-400 border border-transparent rounded-2xl font-medium text-sm text-white hover:from-indigo-500 hover:to-violet-500 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:ring-offset-2 active:translate-y-0 shadow-md shadow-indigo-200/50 transition duration-300 ease-out']) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}"
            {{ $attributes->merge(['class' => 'inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-400 to-violet-400 border border-transparent rounded-2xl font-medium text-sm text-white hover:from-indigo-500 hover:to-violet-500 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:ring-offset-2 active:translate-y-0 shadow-md shadow-indigo-200/50 transition duration-300 ease-out']) }}>
        {{ $slot }}
    </button>
@endif
