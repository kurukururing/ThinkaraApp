<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // Proses Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $akun = Akun::where('username', $credentials['username'])
                    ->where('is_active', 1)
                    ->first();

        if ($akun && Hash::check($credentials['password'], $akun->password)) {
            // Login menggunakan guard web secara eksplisit
            Auth::guard('web')->login($akun);
            
            $request->session()->regenerate();

            // Cek jika yang login adalah admin, arahkan ke panel admin
            if ($akun->user_role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang Admin!');
            }

            return redirect()->to('/dashboard')->with('success', 'Selamat datang kembali!');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah, atau akun dinonaktifkan.',
        ])->onlyInput('username');
    }

    // Proses Daftar Akun
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:akun,username|max:255',
            'email' => 'required|string|email|unique:akun,email|max:255',
            'password' => 'required|string|min:6|confirmed',
            
            'npm' => 'required|string|size:11|unique:mahasiswa,npm',
            'nama_mahasiswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:20',
            'jenjang' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'instansi' => 'required|string|max:255',
        ]);

        $akun = DB::transaction(function () use ($request) {
            $akunBaru = Akun::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_role' => 'mahasiswa',
                'is_active' => true,
            ]);

            Mahasiswa::create([
                'id_akun' => $akunBaru->id_akun,
                'npm' => $request->npm,
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'jenis_kelamin' => $request->jenis_kelamin,
                'jenjang' => $request->jenjang,
                'tanggal_lahir' => $request->tanggal_lahir,
                'instansi' => $request->instansi,
            ]);

            return $akunBaru;
        });

        // Login menggunakan guard web secara eksplisit
        Auth::guard('web')->login($akun);
        $request->session()->regenerate();

        return redirect()->to('/dashboard')->with('success', 'Pendaftaran berhasil!');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}