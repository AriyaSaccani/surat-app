<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;


class DashboardKaryawanController extends Controller
{
    public function index()
    {
        return view('karyawan.dashboard');
    }
    public function dashboard()
    {
        // Ambil data dari database
        $suratMasuk = SuratMasuk::where('karyawan_id', Auth::id())->count(); // Contoh query
        $suratKeluar = SuratKeluar::where('karyawan_id', Auth::id())->count(); // Contoh query

        // Kirim data ke view
        return view('karyawan.dashboard', compact('suratMasuk', 'suratKeluar'));
    }

}
