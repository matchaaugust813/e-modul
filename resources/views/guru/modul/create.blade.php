<x-app-layout>
    @section('title', 'Tambah Modul Baru')
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <x-btn-secondary href="{{ route('guru.modul.index') }}">
                <x-icon name="panah-kiri" class="w-4 h-4 inline mr-1" />
                Kembali
            </x-btn-secondary>
            <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-100 leading-tight">Tambah Modul Baru</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <x-card title="Form Tambah Modul">
                <form method="POST" action="{{ route('guru.modul.store') }}" enctype="multipart/form-data">
                    @csrf
                    @php $modul = new \App\Models\Modul(); @endphp
                    @include('guru.modul._form')
                    <div class="mt-6 flex gap-3">
                        <x-btn-primary type="submit">Simpan Modul</x-btn-primary>
                        <x-btn-secondary href="{{ route('guru.modul.index') }}">Batal</x-btn-secondary>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>
