<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Soal;
use App\Models\HasilSesiLatihan;
use App\Models\SoalItemBuilder;
use App\Models\SoalItemFallacy;
use App\Models\SoalItemQte;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPengguna = Mahasiswa::count();
        $totalSoal = Soal::count();
        $totalSesi = HasilSesiLatihan::count();
        
        $statistikSesi = HasilSesiLatihan::selectRaw('DATE(waktu_main) as tanggal, COUNT(*) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'desc')
            ->limit(7)
            ->get()
            ->reverse()
            ->values();

        $distribusiSesi = HasilSesiLatihan::selectRaw('id_latihan, COUNT(*) as total')
            ->groupBy('id_latihan')
            ->get()
            ->mapWithKeys(function ($item) {
                $nama = match($item->id_latihan) {
                    1 => 'Argument Builder',
                    2 => 'Fallacy Finder',
                    3 => 'Fix The Argument',
                    4 => 'Gamified QTE',
                    default => 'Lainnya'
                };
                return [$nama => $item->total];
            });

        $distribusiInstansi = Mahasiswa::selectRaw('instansi, COUNT(*) as total')
            ->groupBy('instansi')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get()
            ->pluck('total', 'instansi');

        return view('admin.dashboard', compact('totalPengguna', 'totalSoal', 'totalSesi', 'statistikSesi', 'distribusiSesi', 'distribusiInstansi'));
    }

    public function pengguna()
    {
        // Mengambil data mahasiswa beserta relasi akunnya
        $pengguna = Mahasiswa::with('akun')->get();
        return view('admin.pengguna', compact('pengguna'));
    }

    public function soal()
    {
        $soal = Soal::with(['builderItems', 'fallacyItems', 'qteItems'])->orderBy('id_latihan')->get();
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

        $soal = Soal::create($validated);
        
        $this->saveItems($request, $soal);

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

        // Menghapus item lama sebelum menyimpan yang baru
        $soal->builderItems()->delete();
        $soal->fallacyItems()->delete();
        $soal->qteItems()->delete();
        
        $this->saveItems($request, $soal);

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

    private function saveItems(Request $request, $soal)
    {
        if (in_array($soal->id_latihan, [1, 3])) {
            $types = ['claim', 'evidence', 'reasoning', 'reference'];
            foreach ($types as $type) {
                if ($request->filled("builder_{$type}")) {
                    SoalItemBuilder::create([
                        'id_soal' => $soal->id_soal,
                        'isi_item' => $request->input("builder_{$type}"),
                        'tipe' => $type,
                        'is_correct' => true,
                    ]);
                }
            }
        } elseif ($soal->id_latihan == 2) {
            if ($request->filled('fallacy_correct')) {
                $correct = $request->input('fallacy_correct');
                $fallacies = ['Ad Hominem', 'Slippery Slope', 'Strawman', 'False Dilemma', 'Appeal to Emotion', 'Bandwagon', 'Hasty Generalization'];
                
                SoalItemFallacy::create([
                    'id_soal' => $soal->id_soal,
                    'jenis_kesalahan' => $correct,
                    'is_correct' => true,
                ]);

                // Membuat 3 random jawaban fallacy yang salah
                $wrong = array_diff($fallacies, [$correct]);
                shuffle($wrong);
                foreach (array_slice($wrong, 0, 3) as $w) {
                    SoalItemFallacy::create([
                        'id_soal' => $soal->id_soal,
                        'jenis_kesalahan' => $w,
                        'is_correct' => false,
                    ]);
                }
            }
        } elseif ($soal->id_latihan == 4) {
            if ($request->filled('qte_correct')) {
                $correct = $request->input('qte_correct');
                $wrong = $correct === 'Argumen Logis dan Valid' ? 'Terdapat Kesalahan Logika (Fallacy)' : 'Argumen Logis dan Valid';

                SoalItemQte::create(['id_soal' => $soal->id_soal, 'isi_item' => $correct, 'is_correct' => true]);
                SoalItemQte::create(['id_soal' => $soal->id_soal, 'isi_item' => $wrong, 'is_correct' => false]);
            }
        }
    }
}