@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white/80 border border-slate-200 text-slate-800 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400 rounded-2xl shadow-sm text-sm px-3.5 py-2.5 min-h-[42px] transition duration-200']) }}>
