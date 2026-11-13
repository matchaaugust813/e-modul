<x-guest-layout>
    @section('title', 'Masuk Administrator')

    {{-- Error --}}
    @if ($errors->any())
        <div class="mb-5 p-4 rounded-2xl bg-rose-50 border border-rose-200/60 text-sm text-rose-700">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="mb-6">
        <div class="flex items-center gap-3 mb-1">
            <div class="w-10 h-10 rounded-2xl bg-indigo-100 flex items-center justify-center text-indigo-600">
                <x-icon name="pengaturan" class="w-6 h-6" />
            </div>
            <h2 class="text-xl font-bold text-slate-800">Panel Administrator</h2>
        </div>
        <p class="text-sm text-slate-500">Masuk khusus superadmin atau kepala sekolah.</p>
    </div>

    @php
        $adminPath = config('app.admin_path', 'admin');
    @endphp

    <form method="POST" action="{{ url($adminPath . '/login') }}">
        @csrf

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                          :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Password --}}
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Sandi')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                          required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Remember Me --}}
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                       class="rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-400"
                       name="remember">
                <span class="ms-2 text-sm text-slate-600">Ingat saya</span>
            </label>
        </div>

        <div class="mt-6">
            <button type="submit"
                    class="w-full py-3 px-4 rounded-2xl text-sm font-semibold text-white bg-gradient-to-r from-indigo-500 to-violet-500 hover:from-indigo-600 hover:to-violet-600 hover:-translate-y-0.5 transition duration-300 shadow-md shadow-indigo-200/50">
                Masuk ke Panel Admin
            </button>
        </div>
    </form>
</x-guest-layout>
