<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Soal;
use App\Models\HasilSesiLatihan;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPengguna = Mahasiswa::count();
        $totalSoal = Soal::count();
        $totalSesi = HasilSesiLatihan::count();
        
        return view('admin.dashboard', compact('totalPengguna', 'totalSoal', 'totalSesi'));
    }

    public function pengguna()
    {
        // Mengambil data mahasiswa beserta relasi akunnya
        $pengguna = Mahasiswa::with('akun')->get();
        return view('admin.pengguna', compact('pengguna'));
    }

    public function soal()
    {
        $soal = Soal::orderBy('id_latihan')->get();
        return view('admin.soal', compact('soal'));
    }

    public function storeSoal(Request $request)
    {
        $validated = $request->validate([
            'id_latihan' => 'required|integer',
            'topik' => 'required|string|max:255',
            'isi_soal' => 'required|string',
            'penjelasan' => 'nullable|string',
        ]);

        Soal::create($validated);

        return redirect()->route('admin.soal')->with('success', 'Soal berhasil ditambahkan!');
    }

    public function updateSoal(Request $request, $id)
    {
        $soal = Soal::findOrFail($id);

        $validated = $request->validate([
            'id_latihan' => 'required|integer',
            'topik' => 'required|string|max:255',
            'isi_soal' => 'required|string',
            'penjelasan' => 'nullable|string',
        ]);

        $soal->update($validated);

        return redirect()->route('admin.soal')->with('success', 'Soal berhasil diperbarui!');
    }

    public function destroySoal($id)
    {
        $soal = Soal::findOrFail($id);
        
        // Menghapus rekaman tabel relasi terkait agar tidak terjadi error konstrain Foreign Key
        $soal->builderItems()->delete();
        $soal->fallacyItems()->delete();
        $soal->qteItems()->delete();
        $soal->delete();

        return redirect()->route('admin.soal')->with('success', 'Soal berhasil dihapus!');
    }
}