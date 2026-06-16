<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Models\Quiz;
use App\Models\QuizSoal;
use App\Models\Soal;
use App\Models\SoalItemBuilder;
use App\Models\SoalItemFallacy;
use App\Models\SoalItemQte;

class QuizController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [function ($request, $next) {
            // Pastikan hanya role mahasiswa yang boleh mengakses URL Quiz
            if (auth()->check() && auth()->user()->user_role !== 'mahasiswa') {
                $intendedUrl = $request->fullUrl();
                
                // Logout akun non-mahasiswa (dosen/admin)
                auth()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                // Simpan URL quiz tujuan dan arahkan ke login
                session()->put('url.intended', $intendedUrl);
                return redirect()->route('login')->withErrors(['username' => 'Silakan login dengan akun Mahasiswa untuk mengerjakan quiz ini.']);
            }
            return $next($request);
        }];
    }

    public function join($slug)
    {
        $quiz = Quiz::with('latihan')->where('slug', $slug)->firstOrFail();
        
        if (!$quiz->is_active) {
            return redirect()->route('dashboard')->with('error', 'Quiz ini sudah dinonaktifkan oleh dosen.');
        }

        return view('main.quiz_join', compact('quiz'));
    }

    public function start(Request $request, $slug)
    {
        $quiz = Quiz::where('slug', $slug)->firstOrFail();
        
        session([
            'active_quiz' => $slug,
            'quiz_urutan' => 1,
            'quiz_score' => 0,
            'quiz_xp' => 0
        ]);

        return redirect()->route('quiz.play', ['slug' => $slug, 'urutan' => 1]);
    }

    public function play($slug, $urutan)
    {
        $quiz = Quiz::where('slug', $slug)->firstOrFail();
        $quizSoal = QuizSoal::where('id_quiz', $quiz->id_quiz)->where('urutan', $urutan)->firstOrFail();
        $soal = Soal::findOrFail($quizSoal->id_soal);
        
        session(['quiz_urutan' => $urutan]);
        
        if ($quiz->id_latihan == 1) {
            $items = SoalItemBuilder::where('id_soal', $soal->id_soal)->where('is_correct', true)->get()->unique('tipe')->values()->shuffle();
            return view('main.argumentbuilder', compact('soal', 'items'));
        } elseif ($quiz->id_latihan == 3) {
            $items = SoalItemBuilder::where('id_soal', $soal->id_soal)->where('is_correct', true)->get()->unique('tipe')->values()->shuffle();
            return view('main.fixargument', compact('soal', 'items'));
        } elseif ($quiz->id_latihan == 2) {
            $opsiFallacy = SoalItemFallacy::where('id_soal', $soal->id_soal)->inRandomOrder()->get();
            return view('main.fallacyfinder', compact('soal', 'opsiFallacy'));
        } elseif ($quiz->id_latihan == 4) {
            $opsiQte = SoalItemQte::where('id_soal', $soal->id_soal)->inRandomOrder()->get();
            return view('main.gamifiedqte', compact('soal', 'opsiQte'));
        }

        return redirect()->route('dashboard')->with('error', 'Tipe soal tidak valid.');
    }

    public function pembahasan($slug, $urutan)
    {
        $quiz = Quiz::where('slug', $slug)->firstOrFail();
        $quizSoal = QuizSoal::where('id_quiz', $quiz->id_quiz)->where('urutan', $urutan)->firstOrFail();
        $soal = Soal::findOrFail($quizSoal->id_soal);
        
        $pembahasanData = session('pembahasan_data');
        if (!$pembahasanData) {
            return redirect()->route('quiz.play', ['slug' => $slug, 'urutan' => $urutan]);
        }
        session()->reflash();

        $kunciBuilder = collect();
        if (in_array($pembahasanData['type'], ['argumentbuilder', 'fixargument'])) {
            $kunciBuilder = SoalItemBuilder::where('id_soal', $soal->id_soal)->where('is_correct', true)->get()->unique('tipe')->sortBy(function ($item) {
                $urutanArgumen = ['claim', 'evidence', 'reasoning', 'reference'];
                return array_search($item->tipe, $urutanArgumen);
            })->values();
        }

        $kunciFallacy = $pembahasanData['type'] === 'fallacy' ? SoalItemFallacy::where('id_soal', $soal->id_soal)->where('is_correct', true)->first() : null;
        $kunciQte = $pembahasanData['type'] === 'qte' ? SoalItemQte::where('id_soal', $soal->id_soal)->where('is_correct', true)->first() : null;

        $totalSoal = QuizSoal::where('id_quiz', $quiz->id_quiz)->count();
        $hasNext = $urutan < $totalSoal;
        
        $nextUrl = $hasNext ? route('quiz.play', ['slug' => $slug, 'urutan' => $urutan + 1]) : route('quiz.result', ['slug' => $slug]);

        return view('main.quiz_pembahasan', compact('quiz', 'urutan', 'totalSoal', 'soal', 'pembahasanData', 'kunciBuilder', 'kunciFallacy', 'kunciQte', 'nextUrl', 'hasNext'));
    }

    public function result($slug)
    {
        $quiz = Quiz::where('slug', $slug)->firstOrFail();
        $score = session('quiz_score', 0);
        $xp = session('quiz_xp', 0);
        
        session()->forget(['active_quiz', 'quiz_urutan', 'quiz_score', 'quiz_xp']);

        return view('main.quiz_result', compact('quiz', 'score', 'xp'));
    }
}