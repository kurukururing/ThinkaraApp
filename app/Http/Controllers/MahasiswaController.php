<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Akun;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan halaman dashboard khusus mahasiswa.
     */
    public function dashboard()
    {
        // Data yang dibutuhkan di dashboard bisa dipersiapkan di sini
        // Contoh: $user = Auth::user();
        return view('main.dashboard');
    }

    /**
     * Menampilkan halaman profil mahasiswa yang sedang login.
     */
    public function profil()
    {
        $akun = Auth::user();
        // Eager load relasi mahasiswa untuk efisiensi query
        $akun->load('mahasiswa'); 
        
        return view('main.profil', compact('akun'));
    }

    /**
     * Memproses pembaruan data diri (informasi pribadi) mahasiswa.
     */
    public function updateProfil(Request $request)
    {
        $akun = Auth::user();
        $mahasiswa = $akun->mahasiswa;

        $validated = $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('akun')->ignore($akun->id_akun, 'id_akun'),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('akun')->ignore($akun->id_akun, 'id_akun'),
            ],
            'jenjang' => 'nullable|string|max:20',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|string|max:20',
            'instansi' => 'nullable|string|max:255',
        ]);

        // Update tabel akun
        $akun->update([
            'username' => $validated['username'],
            'email' => $validated['email'],
        ]);

        // Update tabel mahasiswa
        $mahasiswa?->update($validated);

        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Memproses pembaruan password mahasiswa.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string|current_password',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Auth::user()->update(['password' => Hash::make($request->password)]);

        return redirect()->route('profil')->with('success', 'Password berhasil diperbarui!');
    }

    /**
     * Menampilkan riwayat latihan spesifik untuk mahasiswa.
     */
    public function riwayatLatihan()
    {
        // Logika untuk mengambil riwayat latihan dari database bisa ditambahkan di sini
        $riwayat = []; // Placeholder

        return view('main.riwayat', compact('riwayat'));
    }
}