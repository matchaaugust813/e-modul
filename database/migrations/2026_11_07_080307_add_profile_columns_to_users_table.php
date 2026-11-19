<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tahap 5A: Tambah kolom profil, status, soft-deletes, dan ubah role ke string.
     */
    public function up(): void
    {
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check');
        }

        Schema::table('users', function (Blueprint $table) {
            // Ubah kolom role dari enum ke string agar bisa menampung 'superadmin'
            $table->string('role')->default('siswa')->change();

            // Status akun: active, pending, rejected
            $table->string('status')->default('active')->after('role');

            // Kolom profil siswa
            $table->unsignedBigInteger('kelas_id')->nullable()->after('status');
            $table->string('nis')->nullable()->after('kelas_id');

            // Kolom profil guru
            $table->string('mata_pelajaran_diampu')->nullable()->after('nis');
            $table->string('nip')->nullable()->after('mata_pelajaran_diampu');

            // Soft deletes
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn(['status', 'kelas_id', 'nis', 'mata_pelajaran_diampu', 'nip']);
            $table->enum('role', ['siswa', 'guru'])->default('siswa')->change();
        });
    }
};
