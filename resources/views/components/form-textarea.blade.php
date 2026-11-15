@props(['label', 'name', 'value' => '', 'rows' => 4, 'required' => false])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1.5">
        {{ $label }}
        @if($required) <span class="text-rose-500 dark:text-rose-400">*</span> @endif
    </label>
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'w-full bg-white/80 dark:bg-slate-900/80 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition duration-300 ease-out']) }}
    >{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="mt-1 text-sm text-rose-600 dark:text-rose-400">{{ $message }}</p>
    @enderror
</div>
