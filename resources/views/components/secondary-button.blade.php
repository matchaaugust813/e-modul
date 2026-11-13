<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-5 py-2.5 bg-white/80 border border-slate-200 rounded-2xl font-medium text-sm text-slate-700 hover:bg-white hover:border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 shadow-sm disabled:opacity-50 transition duration-200']) }}>
    {{ $slot }}
</button>
