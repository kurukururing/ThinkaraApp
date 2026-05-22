<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\SoalItemBuilder;
use App\Models\SoalItemFallacy; // Pastikan model ini sudah dibuat
use App\Models\SoalItemQte;

class SoalController extends Controller
{
    /**
     * Menampilkan halaman Fix The Argument / Argument Builder dengan data dinamis.
     */
    public function getFixArgument()
    {
        // ID Latihan 3 = Fix The Argument
        $soal = Soal::where('id_latihan', 3)->whereHas('builderItems')->inRandomOrder()->first();

        if (!$soal) {
            // Redirect atau tampilkan pesan jika tidak ada soal yang valid
            return redirect()->route('arena')->with('error', 'Belum ada soal untuk mode ini.');
        }
        
        // Mengambil pilihan jawaban yang berelasi dengan soal tersebut (pastikan hanya 1 dari tiap tipe)
        $items = SoalItemBuilder::where('id_soal', $soal->id_soal)
            ->where('is_correct', true)
            ->get()
            ->unique('tipe') // Filter aman dari data ganda di database
            ->values()
            ->shuffle(); // Acak posisinya (di memory)
        
        return view('main.fixargument', compact('soal', 'items'));
    }

    /**
     * Menampilkan halaman Argument Builder dengan data dinamis.
     */
    public function getArgumentBuilder()
    {
        // ID Latihan 1 = Argument Builder
        $soal = Soal::where('id_latihan', 1)->whereHas('builderItems')->inRandomOrder()->first();

        if (!$soal) {
            return redirect()->route('arena')->with('error', 'Belum ada soal untuk mode ini.');
        }
        
        $items = SoalItemBuilder::where('id_soal', $soal->id_soal)
            ->where('is_correct', true)
            ->get()
            ->unique('tipe')
            ->values()
            ->shuffle();
        
        return view('main.argumentbuilder', compact('soal', 'items'));
    }

    /**
     * Menampilkan halaman Fallacy Finder dengan data dinamis.
     */
    public function getFallacyFinder()
    {
        // ID Latihan 2 = Fallacy Finder
        $soal = Soal::where('id_latihan', 2)->whereHas('fallacyItems')->inRandomOrder()->first();

        if (!$soal) {
            return redirect()->route('arena')->with('error', 'Belum ada soal untuk mode ini.');
        }
        
        // Mengambil pilihan jawaban fallacy yang berelasi dengan soal tersebut
        $opsiFallacy = SoalItemFallacy::where('id_soal', $soal->id_soal)->inRandomOrder()->get();

        return view('main.fallacyfinder', compact('soal', 'opsiFallacy'));
    }

    /**
     * Menampilkan halaman Gamified QTE dengan data dinamis.
     */
    public function getGamifiedQte()
    {
        // ID Latihan 4 = Gamified QTE
        $soal = Soal::where('id_latihan', 4)->whereHas('qteItems')->inRandomOrder()->first();

        if (!$soal) {
            return redirect()->route('arena')->with('error', 'Belum ada soal untuk mode ini.');
        }
        
        $opsiQte = SoalItemQte::where('id_soal', $soal->id_soal)->inRandomOrder()->get();

        return view('main.gamifiedqte', compact('soal', 'opsiQte'));
    }

    /**
     * Logika khusus untuk memproses pengumpulan jawaban tipe Builder (Argument Builder / Fix Argument).
     */
    public function processBuilderAnswer(Request $request, $id)
    {
        $soal = Soal::findOrFail($id);

        $request->validate([
            'jawaban_items'   => 'required|array',
            'jawaban_items.*' => 'integer',
        ]);

        // Mengambil susunan jawaban yang benar dan memastikan hanya ada 4 tipe unik
        $correctItemsQuery = SoalItemBuilder::where('id_soal', $soal->id_soal)
            ->where('is_correct', true)
            ->get()
            ->unique('tipe')
            ->values();
        
        // Urutkan kunci jawaban berdasarkan hierarki argumentasi:
        // Claim -> Evidence -> Reasoning -> Reference
        $urutanArgumen = ['claim', 'evidence', 'reasoning', 'reference'];
        $correctItemsList = $correctItemsQuery->sortBy(function ($item) use ($urutanArgumen) {
            return array_search($item->tipe, $urutanArgumen);
        });

        // Ambil array ID-nya saja dan re-index array-nya mulai dari 0
        $correctItems = $correctItemsList->pluck('id_item_builder')->values()->toArray();
        
        // Parsing input jawaban user ke Integer untuk akurasi saat perbandingan
        $userAnswers = array_map('intval', $request->jawaban_items);
        
        // Mengevaluasi kecocokan ID item dan posisi/urutannya di waktu bersamaan
        $correctCount = count(array_intersect_assoc($correctItems, $userAnswers));
        $totalCorrect = count($correctItems);
        
        // Mengecek apakah urutan jawaban user persis sama dengan kunci jawaban
        $isAllCorrect = ($userAnswers === $correctItems);
        
        if ($isAllCorrect && auth()->check()) {
            // TODO: Tambahkan logika penambahan XP/Skor ke user
            // Contoh: auth()->user()->mahasiswa->increment('skor', 10);
        }
        
        // Membedakan tipe data pembahasan secara spesifik berdasarkan rute (Fix Argument / Argument Builder)
        $type = $request->routeIs('fixargument.process') ? 'fixargument' : 'argumentbuilder';

        // Simpan hasil ke session flash untuk ditampilkan di halaman Pembahasan
        session()->flash('pembahasan_data', [
            'type'          => $type,
            'is_correct'    => $isAllCorrect,
            'correct_count' => $correctCount,
            'total_correct' => $totalCorrect,
            'message'       => $isAllCorrect ? 'Tepat sekali! Susunan argumen sudah benar.' : "Masih ada bagian yang kurang tepat ($correctCount dari $totalCorrect posisi benar). Coba perbaiki lagi!"
        ]);

        // Kirimkan response berupa URL tujuan (halaman pembahasan)
        return response()->json([
            'success'       => true,
            'redirect_url'  => route('pembahasan', $id)
        ]);
    }

    /**
     * Logika khusus untuk memproses tebakan jawaban tipe Fallacy.
     */
    public function processFallacyAnswer(Request $request, $id)
    {
        $soal = Soal::findOrFail($id);

        $request->validate([
            'id_item_fallacy' => 'required|integer',
        ]);

        // Cari item fallacy yang dipilih oleh user
        $jawabanUser = SoalItemFallacy::where('id_item_fallacy', $request->id_item_fallacy)
                                      ->where('id_soal', $soal->id_soal)
                                      ->first();

        if (!$jawabanUser) {
            return response()->json(['success' => false, 'message' => 'Jawaban tidak valid.'], 422);
        }

        $isCorrect = (bool) $jawabanUser->is_correct;

        // TODO: Tambahkan kalkulasi dan penyimpanan Skor/XP ke profil user di sini
        
        // Simpan hasil ke session flash
        session()->flash('pembahasan_data', [
            'type'       => 'fallacy',
            'is_correct' => $isCorrect,
            'message'    => $isCorrect ? 'Analisis tajam! Anda menemukan cacat logikanya.' : 'Tebakan fallacy Anda masih keliru, coba lagi!'
        ]);

        return response()->json([
            'success'    => true,
            'redirect_url' => route('pembahasan', $id)
        ]);
    }

    /**
     * Logika khusus untuk memproses jawaban Gamified QTE.
     */
    public function processQteAnswer(Request $request, $id)
    {
        $soal = Soal::findOrFail($id);

        $request->validate([
            'id_item_qte' => 'required|integer',
        ]);

        $jawabanUser = SoalItemQte::where('id_item_qte', $request->id_item_qte)
                                  ->where('id_soal', $soal->id_soal)
                                  ->first();

        if (!$jawabanUser) {
            return response()->json(['success' => false, 'message' => 'Jawaban tidak valid.'], 422);
        }

        $isCorrect = (bool) $jawabanUser->is_correct;

        session()->flash('pembahasan_data', [
            'type'       => 'qte',
            'is_correct' => $isCorrect,
            'message'    => $isCorrect ? 'Cepat dan Tepat! Analisis Anda akurat.' : 'Sayang sekali, reaksi atau jawaban Anda kurang tepat!'
        ]);

        return response()->json([
            'success'      => true,
            'redirect_url' => route('pembahasan', $id)
        ]);
    }

    /**
     * Menampilkan halaman Pembahasan
     */
    public function getPembahasan($id)
    {
        $soal = Soal::findOrFail($id);
        $pembahasanData = session('pembahasan_data');

        // Jika tidak ada data sesi pengerjaan (misal user me-refresh), kembalikan ke arena
        if (!$pembahasanData) {
            return redirect()->route('arena')->with('error', 'Sesi pembahasan telah berakhir.');
        }

        // Pertahankan sesi supaya tidak hilang jika user me-refresh halaman pembahasan
        session()->reflash();

        $kunciBuilder = collect();
        if (in_array($pembahasanData['type'], ['argumentbuilder', 'fixargument'])) {
            $kunciBuilder = SoalItemBuilder::where('id_soal', $id)
                ->where('is_correct', true)
                ->get()
                ->unique('tipe'); // Memastikan hanya ada 4 jawaban (1 dari tiap tipe)
                
            $urutanArgumen = ['claim', 'evidence', 'reasoning', 'reference'];
            $kunciBuilder = $kunciBuilder->sortBy(function ($item) use ($urutanArgumen) {
                return array_search($item->tipe, $urutanArgumen);
            })->values();
        }

        $kunciFallacy = null;
        if ($pembahasanData['type'] === 'fallacy') {
            $kunciFallacy = SoalItemFallacy::where('id_soal', $id)->where('is_correct', true)->first();
        }

        $kunciQte = null;
        if ($pembahasanData['type'] === 'qte') {
            $kunciQte = SoalItemQte::where('id_soal', $id)->where('is_correct', true)->first();
        }

        return view('main.pembahasan', compact('soal', 'pembahasanData', 'kunciBuilder', 'kunciFallacy', 'kunciQte'));
    }
}