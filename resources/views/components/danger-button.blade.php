<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2.5 bg-rose-500 border border-transparent rounded-2xl font-medium text-sm text-white hover:bg-rose-600 focus:outline-none focus:ring-2 focus:ring-rose-400 focus:ring-offset-2 shadow-sm transition duration-200']) }}>
    {{ $slot }}
</button>
