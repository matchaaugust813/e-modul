<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = ['nomor', 'jenjang'];

    /**
     * Kelas memiliki banyak mata pelajaran.
     */
    public function mataPelajarans(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(MataPelajaran::class, 'kelas_id');
    }

    /**
     * Label lengkap kelas, misal: "Kelas 1 SD".
     */
    public function getLabelAttribute(): string
    {
        return "Kelas {$this->nomor} {$this->jenjang}";
    }
}
