<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Mengecek apakah user sudah login dan memiliki role 'admin'
        if (Auth::check() && Auth::user()->user_role === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, kembalikan ke halaman dashboard biasa dengan pesan error
        return redirect()->route('dashboard')
            ->with('error', 'Akses ditolak! Anda tidak memiliki izin untuk membuka halaman Admin.');
    }
}