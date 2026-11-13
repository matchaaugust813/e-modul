<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Buat akun-akun dasar: superadmin, guru, dan siswa.
     * Menggunakan updateOrCreate agar aman dijalankan berulang kali.
     */
    public function run(): void
    {
        // Akun demo hanya dibuat jika lingkungan lokal (APP_ENV=local)
        if (! app()->environment('local')) {
            return;
        }

        // Akun Superadmin (Kepala Sekolah)
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'     => 'Admin Kepala',
                'password' => Hash::make('password'),
                'role'     => 'superadmin',
                'status'   => 'active',
            ]
        );

        // Akun Guru
        User::updateOrCreate(
            ['email' => 'guru@example.com'],
            [
                'name'     => 'Budi Santoso',
                'password' => Hash::make('password'),
                'role'     => 'guru',
                'status'   => 'active',
            ]
        );

        // Akun Siswa
        User::updateOrCreate(
            ['email' => 'siswa@example.com'],
            [
                'name'     => 'Ani Rahayu',
                'password' => Hash::make('password'),
                'role'     => 'siswa',
                'status'   => 'active',
            ]
        );
    }
}
