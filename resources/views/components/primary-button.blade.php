<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-500 to-violet-500 border border-transparent rounded-2xl font-medium text-sm text-white hover:from-indigo-600 hover:to-violet-600 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 shadow-sm transition duration-200']) }}>
    {{ $slot }}
</button>
