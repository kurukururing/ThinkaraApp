<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Akun;
use App\Models\Mahasiswa;
use App\Models\Dosen;

class AuthController extends Controller
{
    /**
     * Memproses permintaan login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Pengalihan spesifik role dosen/admin/mahasiswa sudah 
            // ditangani oleh route /dashboard di web.php
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password yang dimasukkan salah.',
        ])->onlyInput('username');
    }

    /**
     * Memproses pendaftaran akun baru.
     */
    public function register(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'username'       => 'required|string|max:255|unique:akun,username',
            'email'          => 'required|string|email|max:255|unique:akun,email',
            'password'       => 'required|string|min:6|confirmed',
            'user_role'      => 'required|in:mahasiswa,dosen',
            
            // Kolom nama_mahasiswa hanya wajib diisi jika mendaftar sebagai mahasiswa
            'nama_mahasiswa' => 'required_if:user_role,mahasiswa|nullable|string|max:255',
            'npm'            => 'required_if:user_role,mahasiswa|nullable|string|max:50',
            'instansi'       => 'nullable|string|max:255',
            'jenjang'        => 'nullable|string|max:20',
            'tanggal_lahir'  => 'nullable|date',
            'jenis_kelamin'  => 'nullable|string|max:20',
            'nama_dosen'     => 'required_if:user_role,dosen|nullable|string|max:255',
        ]);

        // 1. Buat data di tabel akun
        $akun = Akun::create([
            'username'  => $validated['username'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'user_role' => $validated['user_role'],
            'is_active' => 1,
        ]);

        // 2. Jika yang mendaftar adalah mahasiswa, buatkan relasi data di tabel Mahasiswa
        if ($validated['user_role'] === 'mahasiswa') {
            Mahasiswa::create([
                'id_akun'        => $akun->id_akun, 
                'nama_mahasiswa' => $validated['nama_mahasiswa'],
                'npm'            => $validated['npm'] ?? '-',
                'instansi'       => $validated['instansi'] ?? null,
                'jenjang'        => $validated['jenjang'] ?? null,
                'tanggal_lahir'  => $validated['tanggal_lahir'] ?? null,
                'jenis_kelamin'  => $validated['jenis_kelamin'] ?? null,
            ]);
        } elseif ($validated['user_role'] === 'dosen') {
            // 3. Jika yang mendaftar adalah dosen, buatkan relasi data di tabel Dosen
            Dosen::create([
                'id_akun'    => $akun->id_akun,
                'nama_dosen' => $validated['nama_dosen'],
            ]);
        }

        // Otomatis login setelah pendaftaran berhasil
        Auth::login($akun);

        return redirect()->route('dashboard');
    }

    /**
     * Mengeluarkan pengguna dari sesi.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
