<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // Jika user tidak terautentikasi, arahkan ke halaman login
        if (! $request->expectsJson()) {
            return route('login');
        }

        // Cek apakah pengguna sudah login
        if (Auth::check()) {
            // Jika pengguna bukan admin atau karyawan, arahkan ke halaman yang sesuai
            if (Auth::user()->role == 'admin') {
                return route('admin-dashboard'); // Admin diarahkan ke dashboard admin
            } elseif (Auth::user()->role == 'karyawan') {
                return route('karyawan-dashboard'); // Karyawan diarahkan ke dashboard karyawan
            }
        }
        
        // Jika tidak ada kondisi yang terpenuhi, arahkan ke halaman login default
        return route('login');
    }
}
