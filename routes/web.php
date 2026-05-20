<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SoalController;
use Illuminate\Support\Facades\Auth;

// =========================================================================
// 1. HALAMAN UMUM (Bisa diakses siapa saja)
// =========================================================================
Route::get('/', function () {
    return view('index');
});

// =========================================================================
// 2. AKSES GUEST (Hanya untuk yang BELUM login)
// =========================================================================
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('login');
})->name('login');

Route::get('/register', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('register');
})->name('register');

// Amankan rute pengiriman data form POST ke Controller
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// =========================================================================
// 3. PROTEKSI DASHBOARD & FITUR UTAMA (Wajib Login)
// =========================================================================
Route::middleware(['auth'])->group(function () {
    
    // Rute Autentikasi
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Rute Mahasiswa & Profil
    Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('dashboard');
    Route::get('/profil', [MahasiswaController::class, 'profil'])->name('profil');
    Route::post('/profil/update', [MahasiswaController::class, 'updateProfil'])->name('profil.update');
    Route::post('/profil/password', [MahasiswaController::class, 'updatePassword'])->name('profil.password.update');

    // Rute Fitur Utama
    Route::get('/leaderboard', function () {
        return view('main.peringkat');
    })->name('leaderboard');

    Route::get('/arena', function () {
        return view('main.arena');
    })->name('arena');

    // Rute Latihan Soal
    Route::get('/fixargument', [SoalController::class, 'getFixArgument'])->name('fixargument');
    Route::post('/fixargument/{soal}', [SoalController::class, 'processBuilderAnswer'])->name('fixargument.process');

    Route::get('/fallacyfinder', [SoalController::class, 'getFallacyFinder'])->name('fallacyfinder');
    Route::post('/fallacyfinder/{soal}', [SoalController::class, 'processFallacyAnswer'])->name('fallacyfinder.process');

    Route::get('/gamifiedqte', function () {
        return view('main.gamifiedqte');
    })->name('gamifiedqte');
});