<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizSoal;
use App\Models\Latihan;
use App\Models\Soal;

class DosenController extends Controller
{
    /**
     * Batas maksimal quiz yang dapat dibuat per akun dosen.
     */
    const MAX_QUIZ_PER_DOSEN = 10;

    /**
     * Jumlah soal acak per quiz.
     */
    const SOAL_PER_QUIZ = 5;

    public function index()
    {
        $quizList = Quiz::with('latihan')
            ->where('id_akun', Auth::id())
            ->latest()
            ->get();

        $jenisList = Latihan::all(); // dropdown pilihan jenis latihan
        $totalQuiz  = $quizList->count();
        $maxQuiz    = self::MAX_QUIZ_PER_DOSEN;

        return view('dosen.dashboard', compact('quizList', 'jenisList', 'totalQuiz', 'maxQuiz'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'nama_quiz'   => 'required|string|max:255',
        'id_latihan'  => 'required|exists:latihan,id_latihan',
    ]);

    // Cek batas kuota
    $existing = Quiz::where('id_akun', Auth::id())->count();
    if ($existing >= self::MAX_QUIZ_PER_DOSEN) {
        return back()->with('error', "Kamu sudah mencapai batas maksimal {$existing} quiz. Hapus quiz lama terlebih dahulu.");
    }

    // Mapping: jenis latihan yang berbagi bank soal yang sama
    // Fix the Argument menggunakan bank soal Argument Builder
    $bankSoalMapping = [
        'Fix the Argument' => 'Argument Builder',
    ];

    $latihanDipilih = Latihan::findOrFail($request->id_latihan);
    
    // Cek apakah latihan ini perlu dialihkan ke bank soal latihan lain
    $namaBankSoal = $bankSoalMapping[$latihanDipilih->nama_latihan] ?? $latihanDipilih->nama_latihan;
    
    // Ambil id_latihan yang dipakai untuk mengambil soal
    $latihanBankSoal = Latihan::where('nama_latihan', $namaBankSoal)->firstOrFail();

    // Ambil 5 soal acak dari bank soal yang sesuai
    $soalAcak = Soal::where('id_latihan', $latihanBankSoal->id_latihan)
        ->inRandomOrder()
        ->limit(self::SOAL_PER_QUIZ)
        ->get();

    if ($soalAcak->count() < self::SOAL_PER_QUIZ) {
        return back()->with('error', 'Bank soal jenis latihan ini belum cukup (minimal 5 soal). Hubungi admin.');
    }

    // Buat quiz — id_latihan tetap menyimpan pilihan dosen (Fix the Argument)
    // bukan id bank soalnya, agar label di halaman tetap benar
    $quiz = Quiz::create([
        'id_akun'    => Auth::id(),
        'id_latihan' => $request->id_latihan,
        'nama_quiz'  => $request->nama_quiz,
        'slug'       => Str::random(10),
        'is_active'  => true,
    ]);

    foreach ($soalAcak as $urutan => $soal) {
        QuizSoal::create([
            'id_quiz'  => $quiz->id_quiz,
            'id_soal'  => $soal->id_soal,
            'urutan'   => $urutan + 1,
        ]);
        }

        return back()->with('success', 'Quiz berhasil dibuat! Link sudah siap dibagikan.');
    }

    public function destroy(Quiz $quiz)
    {
        // Pastikan hanya pemilik yang bisa hapus
        if ($quiz->id_akun !== Auth::id()) {
            abort(403);
        }

        $quiz->delete();

        return back()->with('success', 'Quiz berhasil dihapus.');
    }

    public function toggle(Quiz $quiz)
    {
        if ($quiz->id_akun !== Auth::id()) {
            abort(403);
        }

        $quiz->update(['is_active' => !$quiz->is_active]);

        $status = $quiz->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Quiz berhasil {$status}.");
    }
}