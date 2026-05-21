<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\SoalItemBuilder;
use App\Models\SoalItemFallacy; // Pastikan model ini sudah dibuat

class SoalController extends Controller
{
    /**
     * Menampilkan halaman Fix The Argument / Argument Builder dengan data dinamis.
     */
    public function getFixArgument()
    {
        // Mengambil 1 soal acak (dapat disesuaikan jika ingin mengurutkan berdasarkan level)
        $soal = Soal::whereHas('builderItems')->inRandomOrder()->first();

        if (!$soal) {
            // Redirect atau tampilkan pesan jika tidak ada soal yang valid
            return redirect()->route('arena')->with('error', 'Belum ada soal untuk mode ini.');
        }
        
        // Mengambil pilihan jawaban yang berelasi dengan soal tersebut (diacak posisinya)
        $items = SoalItemBuilder::where('id_soal', $soal->id_soal)->inRandomOrder()->get();
        
        return view('main.fixargument', compact('soal', 'items'));
    }

    /**
     * Menampilkan halaman Argument Builder dengan data dinamis.
     */
    public function getArgumentBuilder()
    {
        $soal = Soal::whereHas('builderItems')->inRandomOrder()->first();

        if (!$soal) {
            return redirect()->route('arena')->with('error', 'Belum ada soal untuk mode ini.');
        }
        
        $items = SoalItemBuilder::where('id_soal', $soal->id_soal)->inRandomOrder()->get();
        
        return view('main.argumentbuilder', compact('soal', 'items'));
    }

    /**
     * Menampilkan halaman Fallacy Finder dengan data dinamis.
     */
    public function getFallacyFinder()
    {
        // Mengambil 1 soal acak yang memiliki item fallacy
        $soal = Soal::whereHas('fallacyItems')->inRandomOrder()->first();

        if (!$soal) {
            return redirect()->route('arena')->with('error', 'Belum ada soal untuk mode ini.');
        }
        
        // Mengambil pilihan jawaban fallacy yang berelasi dengan soal tersebut
        $opsiFallacy = SoalItemFallacy::where('id_soal', $soal->id_soal)->inRandomOrder()->get();

        return view('main.fallacyfinder', compact('soal', 'opsiFallacy'));
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

        // Mengambil array ID item builder yang seharusnya dirangkai (is_correct = true).
        // Asumsi Primary Key adalah 'id'. Sesuaikan jika berbeda.
        $correctItems = SoalItemBuilder::where('id_soal', $soal->id_soal)
            ->where('is_correct', true)
            ->pluck('id')
            ->toArray();
        
        $userAnswers = $request->jawaban_items;
        
        // Mengevaluasi jumlah jawaban yang tepat dan yang dijawab oleh user
        // Menggunakan array_intersect_assoc untuk mencocokkan nilai sekaligus urutannya
        $correctCount = count(array_intersect_assoc($correctItems, $userAnswers));
        $totalCorrect = count($correctItems);
        
        // Mengecek apakah urutan jawaban user persis sama dengan kunci jawaban
        $isAllCorrect = ($userAnswers === $correctItems);
        
        // TODO: Anda dapat menyisipkan logika penambahan XP/Skor untuk user yang sedang login di sini
        
        return response()->json([
            'success'       => true,
            'is_correct'    => $isAllCorrect,
            'correct_count' => $correctCount,
            'total_correct' => $totalCorrect,
            'message'       => $isAllCorrect ? 'Tepat sekali! Susunan argumen sudah benar.' : 'Masih ada bagian yang kurang tepat, coba perbaiki lagi.'
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
        $jawabanUser = SoalItemFallacy::where('id', $request->id_item_fallacy)
                                      ->where('id_soal', $soal->id_soal)
                                      ->first();

        if (!$jawabanUser) {
            return response()->json(['success' => false, 'message' => 'Jawaban tidak valid.'], 422);
        }

        $isCorrect = (bool) $jawabanUser->is_correct;

        // TODO: Tambahkan kalkulasi dan penyimpanan Skor/XP ke profil user di sini
        
        return response()->json([
            'success'    => true,
            'is_correct' => $isCorrect,
            'message'    => $isCorrect ? 'Analisis tajam! Anda menemukan cacat logikanya.' : 'Tebakan fallacy Anda masih keliru, coba lagi!'
        ]);
    }
}