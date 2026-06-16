<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsDosen
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Mengecek apakah user sudah login dan memiliki role 'dosen'
        if (Auth::check() && Auth::user()->user_role === 'dosen') {
            return $next($request);
        }

        // Jika bukan dosen, kembalikan ke halaman dashboard biasa dengan pesan error
        return redirect()->route('dashboard')
            ->with('error', 'Akses ditolak! Anda tidak memiliki izin untuk membuka halaman Dosen.');
    }
}