<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kelas;

class KelasController extends Controller
{
    /**
     * Tampilkan daftar kelas 1-12 dikelompokkan per jenjang.
     */
    public function index()
    {
        $kelasList = Kelas::orderBy('nomor')->get()->groupBy('jenjang');

        return view('siswa.kelas.index', compact('kelasList'));
    }
}
