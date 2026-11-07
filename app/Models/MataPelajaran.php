<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $table = 'mata_pelajarans';

    protected $fillable = ['kelas_id', 'nama'];

    /**
     * Mata pelajaran milik satu kelas.
     */
    public function kelas(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    /**
     * Mata pelajaran memiliki banyak modul.
     */
    public function moduls(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Modul::class, 'mata_pelajaran_id');
    }
}
