<?php

namespace App\Http\Controllers\karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Letter;

class DashboardController extends Controller
{
    public function index()
    {
        $masuk = Letter::where('letter_type', 'Surat Masuk')->get()->count();
        $keluar = Letter::where('letter_type', 'Surat Keluar')->get()->count();

        return view('pages.karyawan.dashboard',[
            'masuk' => $masuk,
            'keluar' => $keluar
        ]);
    }

    
}
