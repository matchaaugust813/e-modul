@props(['label', 'name', 'type' => 'text', 'value' => '', 'required' => false])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-slate-600 mb-1.5">
        {{ $label }}
        @if($required) <span class="text-rose-400">*</span> @endif
    </label>
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'w-full bg-white/50 border border-white/70 rounded-2xl shadow-sm text-sm text-slate-700 placeholder-slate-400 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300 backdrop-blur transition duration-300 ease-out']) }}
    >
    @error($name)
        <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
    @enderror
</div>
