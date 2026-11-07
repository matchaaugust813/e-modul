<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Seed data kelas 1–12 dengan jenjang:
     * SD  : kelas 1–6
     * SMP : kelas 7–9
     * SMA : kelas 10–12
     */
    public function run(): void
    {
        $data = [];

        // SD: kelas 1-6
        for ($i = 1; $i <= 6; $i++) {
            $data[] = ['nomor' => $i, 'jenjang' => 'SD'];
        }

        // SMP: kelas 7-9
        for ($i = 7; $i <= 9; $i++) {
            $data[] = ['nomor' => $i, 'jenjang' => 'SMP'];
        }

        // SMA: kelas 10-12
        for ($i = 10; $i <= 12; $i++) {
            $data[] = ['nomor' => $i, 'jenjang' => 'SMA'];
        }

        foreach ($data as $kelas) {
            Kelas::create($kelas);
        }
    }
}
