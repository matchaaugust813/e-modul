{{-- Dropdown bertingkat: Kelas -> Mata Pelajaran --}}
<div x-data="{
    kelasList: {{ $kelasList->toJson() }},
    kelasId: '{{ old('kelas_id', $modul->mataPelajaran->kelas_id ?? '') }}',
    mapelList: [],
    mapelId: '{{ old('mata_pelajaran_id', $modul->mata_pelajaran_id ?? '') }}',
    init() {
        this.updateMapel();
    },
    updateMapel() {
        const kelas = this.kelasList.find(k => k.id == this.kelasId);
        this.mapelList = kelas ? kelas.mata_pelajarans : [];
    }
}" class="space-y-5">

    {{-- Pilih Kelas --}}
    <div>
        <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1.5">
            Kelas <span class="text-rose-500 dark:text-rose-400">*</span>
        </label>
        <select
            x-model="kelasId"
            @change="updateMapel(); mapelId = ''"
            class="w-full bg-white/80 dark:bg-slate-900/80 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm text-sm text-slate-700 dark:text-slate-100 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition duration-300 ease-out"
        >
            <option value="">-- Pilih Kelas --</option>
            <template x-for="kelas in kelasList" :key="kelas.id">
                <option :value="kelas.id" x-text="`Kelas ${kelas.nomor} ${kelas.jenjang}`"></option>
            </template>
        </select>
    </div>

    {{-- Pilih Mata Pelajaran --}}
    <div>
        <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1.5">
            Mata Pelajaran <span class="text-rose-500 dark:text-rose-400">*</span>
        </label>
        <select
            name="mata_pelajaran_id"
            x-model="mapelId"
            class="w-full bg-white/80 dark:bg-slate-900/80 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm text-sm text-slate-700 dark:text-slate-100 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition duration-300 ease-out"
            required
        >
            <option value="">-- Pilih Mata Pelajaran --</option>
            <template x-for="mapel in mapelList" :key="mapel.id">
                <option :value="mapel.id" x-text="mapel.nama"></option>
            </template>
        </select>
        @error('mata_pelajaran_id')
            <p class="mt-1 text-sm text-rose-500 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>

    <x-form-input
        label="Judul Modul"
        name="judul"
        :value="$modul->judul ?? ''"
        :required="true"
        placeholder="Contoh: Bab 1 - Pengantar Fisika"
    />

    <x-form-textarea
        label="Deskripsi"
        name="deskripsi"
        :value="$modul->deskripsi ?? ''"
        rows="4"
        placeholder="Deskripsi singkat isi modul (opsional)"
    />

    {{-- Upload PDF --}}
    <div>
        <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1.5">
            File PDF {{ isset($modul->id) ? '(kosongkan jika tidak diganti)' : '' }}
            @if(!isset($modul->id)) <span class="text-rose-500 dark:text-rose-400">*</span> @endif
        </label>
        <input
            type="file"
            name="file"
            accept=".pdf,application/pdf"
            {{ !isset($modul->id) ? 'required' : '' }}
            class="block w-full text-sm text-slate-600 dark:text-slate-300
                   file:mr-4 file:py-2 file:px-4
                   file:rounded-2xl file:border-0
                   file:text-sm file:font-medium
                   file:bg-indigo-50/80 dark:file:bg-indigo-950/40 file:text-indigo-600 dark:file:text-indigo-400
                   hover:file:bg-indigo-100/80 dark:hover:file:bg-indigo-900/40 transition duration-300"
        >
        <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">Format: PDF. Ukuran maksimal: 20 MB.</p>
        @error('file')
            <p class="mt-1 text-sm text-rose-500 dark:text-rose-400">{{ $message }}</p>
        @enderror

        @if(isset($modul->id) && $modul->file_path)
            <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                File saat ini: <span class="font-medium text-slate-700 dark:text-slate-200">{{ basename($modul->file_path) }}</span>
                ({{ format_ukuran($modul->ukuran) }})
            </p>
        @endif
    </div>
</div>
