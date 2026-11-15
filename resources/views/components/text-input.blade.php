@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white/80 dark:bg-slate-900/80 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400 rounded-2xl shadow-sm text-sm px-3.5 py-2.5 min-h-[42px] transition duration-200']) }}>
