<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kelas;

class MapelController extends Controller
{
    /**
     * Tampilkan daftar mata pelajaran untuk kelas tertentu.
     */
    public function index(Kelas $kelas)
    {
        $mataPelajarans = $kelas->mataPelajarans()->orderBy('nama')->get();

        return view('siswa.mapel.index', compact('kelas', 'mataPelajarans'));
    }
}
