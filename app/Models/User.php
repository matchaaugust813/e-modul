<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'status', 'kelas_id', 'nis', 'mata_pelajaran_diampu', 'nip'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ─────────────────────────── Role Checks ───────────────────────────

    /**
     * Cek apakah user adalah superadmin.
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'superadmin';
    }

    /**
     * Cek apakah user adalah guru.
     */
    public function isGuru(): bool
    {
        return $this->role === 'guru';
    }

    /**
     * Cek apakah user adalah siswa.
     */
    public function isSiswa(): bool
    {
        return $this->role === 'siswa';
    }

    // ─────────────────────────── Status Checks ───────────────────────────

    /**
     * Cek apakah akun berstatus aktif.
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Cek apakah akun berstatus pending (menunggu persetujuan).
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Cek apakah akun berstatus ditolak.
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    // ─────────────────────────── Relations ───────────────────────────

    /**
     * Relasi: guru memiliki banyak modul.
     */
    public function moduls(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Modul::class, 'guru_id');
    }
}
