<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard guru.
     */
    public function index(Request $request)
    {
        return view('guru.dashboard', [
            'user' => $request->user(),
        ]);
    }
}
