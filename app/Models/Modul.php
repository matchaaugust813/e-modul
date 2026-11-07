<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;

    protected $table = 'moduls';

    protected $fillable = [
        'mata_pelajaran_id',
        'guru_id',
        'judul',
        'deskripsi',
        'file_path',
        'ukuran',
    ];

    /**
     * Modul milik satu mata pelajaran.
     */
    public function mataPelajaran(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

    /**
     * Modul dibuat oleh satu guru (user).
     * Gunakan withTrashed() agar modul tetap menampilkan nama guru meski akunnya soft-deleted.
     */
    public function guru(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'guru_id')->withTrashed();
    }
}
