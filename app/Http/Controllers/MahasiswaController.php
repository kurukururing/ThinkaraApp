<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Akun;
use App\Models\Mahasiswa;
use App\Models\HasilSesiLatihan;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan halaman dashboard khusus mahasiswa.
     */
    public function dashboard()
    {
        $akun = Auth::user();
        $totalXp = HasilSesiLatihan::where('id_akun', $akun->id_akun)->sum('xp');
        $totalSkor = HasilSesiLatihan::where('id_akun', $akun->id_akun)->sum('skor');

        return view('main.dashboard', compact('totalXp', 'totalSkor'));
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
     * Memproses penonaktifan akun (soft delete).
     */
    public function deleteAkun(Request $request)
    {
        $akun = Auth::user();
        
        $akun->update(['is_active' => 0]);

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Akun berhasil dinonaktifkan.');
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

    /**
     * Menampilkan halaman leaderboard (peringkat) berdasarkan akumulasi skor dan xp.
     */
    public function leaderboard()
    {
        $leaderboard = Mahasiswa::join('hasil_sesi_latihan', 'mahasiswa.id_akun', '=', 'hasil_sesi_latihan.id_akun')
            ->select('mahasiswa.id_akun', 'mahasiswa.id_mahasiswa', 'mahasiswa.nama_mahasiswa', 'mahasiswa.instansi')
            ->selectRaw('SUM(hasil_sesi_latihan.skor) as total_skor, SUM(hasil_sesi_latihan.xp) as total_xp')
            ->groupBy('mahasiswa.id_akun', 'mahasiswa.id_mahasiswa', 'mahasiswa.nama_mahasiswa', 'mahasiswa.instansi')
            ->orderBy('total_skor', 'desc')
            ->orderBy('total_xp', 'desc')
            ->get();

        $currentUserRank = null;
        $currentUserData = null;
        
        if (Auth::check()) {
            $currentUserId = Auth::user()->id_akun;
            foreach ($leaderboard as $index => $user) {
                if ($user->id_akun == $currentUserId) {
                    $currentUserRank = $index + 1;
                    $currentUserData = $user;
                    break;
                }
            }
        }

        return view('main.peringkat', compact('leaderboard', 'currentUserRank', 'currentUserData'));
    }
}