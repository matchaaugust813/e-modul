<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard siswa.
     */
    public function index(Request $request)
    {
        return view('siswa.dashboard', [
            'user' => $request->user(),
        ]);
    }
}
