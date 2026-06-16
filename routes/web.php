<?php

use App\Http\Controllers\DosenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\AdminController;
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

    // Rute Dashboard (Redirect based on role)
    Route::get('/dashboard', function () {
        $role = Auth::user()->user_role;
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'dosen') {
            return redirect()->route('dosen.dashboard');
        }
        return app(\App\Http\Controllers\MahasiswaController::class)->dashboard();
    })->name('dashboard');

    // Rute Mahasiswa & Profil
    Route::get('/profil', [MahasiswaController::class, 'profil'])->name('profil');
    Route::post('/profil/update', [MahasiswaController::class, 'updateProfil'])->name('profil.update');
    Route::post('/profil/password', [MahasiswaController::class, 'updatePassword'])->name('profil.password.update');
    Route::post('/profil/delete', [MahasiswaController::class, 'deleteAkun'])->name('profil.delete');

    // Rute Fitur Utama
    Route::get('/leaderboard', [MahasiswaController::class, 'leaderboard'])->name('leaderboard');

    Route::get('/arena', function () {
        return view('main.arena');
    })->name('arena');

    // Rute Latihan Soal
    Route::get('/fixargument', [SoalController::class, 'getFixArgument'])->name('fixargument');
    Route::post('/fixargument/{id}', [SoalController::class, 'processBuilderAnswer'])->name('fixargument.process');

    Route::get('/argumentbuilder', [SoalController::class, 'getArgumentBuilder'])->name('argumentbuilder');
    Route::post('/argumentbuilder/{id}', [SoalController::class, 'processBuilderAnswer'])->name('argumentbuilder.process');

    Route::get('/fallacyfinder', [SoalController::class, 'getFallacyFinder'])->name('fallacyfinder');
    Route::post('/fallacyfinder/{id}', [SoalController::class, 'processFallacyAnswer'])->name('fallacyfinder.process');

    Route::get('/gamifiedqte', [SoalController::class, 'getGamifiedQte'])->name('gamifiedqte');
    Route::post('/gamifiedqte/{id}', [SoalController::class, 'processQteAnswer'])->name('gamifiedqte.process');

    // Rute Halaman Pembahasan
    Route::get('/pembahasan/{id}', [SoalController::class, 'getPembahasan'])->name('pembahasan');

    // Rute Quiz Mahasiswa
    Route::get('/quiz/{slug}', [\App\Http\Controllers\QuizController::class, 'join'])->name('quiz.join');
    Route::post('/quiz/{slug}/start', [\App\Http\Controllers\QuizController::class, 'start'])->name('quiz.start');
    Route::get('/quiz/{slug}/play/{urutan}', [\App\Http\Controllers\QuizController::class, 'play'])->name('quiz.play');
    Route::get('/quiz/{slug}/pembahasan/{urutan}', [\App\Http\Controllers\QuizController::class, 'pembahasan'])->name('quiz.pembahasan');
    Route::get('/quiz/{slug}/result', [\App\Http\Controllers\QuizController::class, 'result'])->name('quiz.result');
});

// =========================================================================
// 4. HALAMAN ADMIN
// =========================================================================
Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/pengguna', [AdminController::class, 'pengguna'])->name('pengguna');
    Route::get('/soal', [AdminController::class, 'soal'])->name('soal');
    Route::post('/soal', [AdminController::class, 'storeSoal'])->name('soal.store');
    Route::put('/soal/{id}', [AdminController::class, 'updateSoal'])->name('soal.update');
    Route::delete('/soal/{id}', [AdminController::class, 'destroySoal'])->name('soal.destroy');
});

// =========================================================================
// 4. HALAMAN DOSEN
// =========================================================================
Route::middleware(['auth', \App\Http\Middleware\IsDosen::class])->prefix('dosen')->name('dosen.')->group(function () {
 
    // Dashboard dosen
    Route::get('/quiz', [DosenController::class, 'index'])->name('dashboard');
    // Buat quiz baru
    Route::post('/quiz', [DosenController::class, 'store'])->name('store');
    // Hapus quiz
    Route::delete('/quiz/{quiz}', [DosenController::class, 'destroy'])->name('destroy');
    // Toggle aktif/nonaktif
    Route::patch('/quiz/{quiz}/toggle', [DosenController::class, 'toggle'])->name('toggle');
    });