<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Buat 1 akun guru dan 1 akun siswa untuk testing.
     */
    public function run(): void
    {
        // Akun Guru
        User::create([
            'name'     => 'Budi Santoso',
            'email'    => 'guru@example.com',
            'password' => Hash::make('password'),
            'role'     => 'guru',
        ]);

        // Akun Siswa
        User::create([
            'name'     => 'Ani Rahayu',
            'email'    => 'siswa@example.com',
            'password' => Hash::make('password'),
            'role'     => 'siswa',
        ]);
    }
}
