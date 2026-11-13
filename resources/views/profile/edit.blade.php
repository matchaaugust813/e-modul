<x-app-layout>
    @section('title', 'Profil Saya')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">Profil Saya</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white/80 border border-slate-200/80 shadow-sm rounded-3xl p-6 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-white/80 border border-slate-200/80 shadow-sm rounded-3xl p-6 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-white/80 border border-slate-200/80 shadow-sm rounded-3xl p-6 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
