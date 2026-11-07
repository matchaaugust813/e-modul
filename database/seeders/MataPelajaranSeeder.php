<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Database\Seeder;

class MataPelajaranSeeder extends Seeder
{
    /**
     * Seed beberapa mata pelajaran contoh per jenjang.
     */
    public function run(): void
    {
        $mapel = [
            'SD'  => ['Matematika', 'Bahasa Indonesia', 'IPA', 'IPS', 'PKN', 'Agama'],
            'SMP' => ['Matematika', 'Bahasa Indonesia', 'Bahasa Inggris', 'IPA', 'IPS', 'PKN'],
            'SMA' => ['Matematika', 'Bahasa Indonesia', 'Bahasa Inggris', 'Fisika', 'Kimia', 'Biologi'],
        ];

        $kelasList = Kelas::all();

        foreach ($kelasList as $kelas) {
            $namaMapel = $mapel[$kelas->jenjang] ?? [];
            foreach ($namaMapel as $nama) {
                MataPelajaran::create([
                    'kelas_id' => $kelas->id,
                    'nama'     => $nama,
                ]);
            }
        }
    }
}
