<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BuatAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:buat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Buat akun superadmin baru secara interaktif';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('--- Pembuatan Akun Superadmin ---');

        $nama = $this->ask('Nama Lengkap');
        while (empty(trim($nama))) {
            $this->error('Nama tidak boleh kosong.');
            $nama = $this->ask('Nama Lengkap');
        }

        $email = $this->ask('Email');
        $validator = Validator::make(['email' => $email], [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        ]);

        if ($validator->fails()) {
            $this->error($validator->errors()->first('email'));
            return Command::FAILURE;
        }

        $password = $this->secret('Kata Sandi (minimal 12 karakter)');
        while (strlen($password) < 12) {
            $this->error('Kata sandi harus minimal 12 karakter.');
            $password = $this->secret('Kata Sandi (minimal 12 karakter)');
        }

        $konfirmasi = $this->secret('Konfirmasi Kata Sandi');
        if ($password !== $konfirmasi) {
            $this->error('Konfirmasi kata sandi tidak cocok.');
            return Command::FAILURE;
        }

        $user = User::create([
            'name' => trim($nama),
            'email' => trim($email),
            'password' => Hash::make($password),
            'role' => 'superadmin',
            'status' => 'active',
        ]);

        $this->info("Akun superadmin [{$user->email}] berhasil dibuat dengan status aktif.");

        return Command::SUCCESS;
    }
}
