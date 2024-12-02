<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        // Cek jika pengguna sudah terautentikasi
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Jika user terautentikasi dan role admin
                if (Auth::user()->role == 'admin') {
                    return redirect(RouteServiceProvider::HOME); // Arahkan ke dashboard admin
                }

                // Jika user terautentikasi dan role karyawan
                if (Auth::user()->role == 'karyawan') {
                    return redirect(RouteServiceProvider::HOME); // Arahkan ke dashboard karyawan
                }

                // Jika role lainnya atau tidak terdefinisi, arahkan ke halaman default
                return redirect(RouteServiceProvider::HOME);
            }
        }

        // Jika user belum terautentikasi, lanjutkan ke request berikutnya
        return $next($request);
    }
}
