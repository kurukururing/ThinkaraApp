<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gabung Quiz | THINKARA</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-slate-700 flex min-h-screen font-nunito items-center justify-center p-6">
    <div class="w-full max-w-lg bg-white p-10 rounded-[2.5rem] shadow-xl border border-slate-50 text-center">
        <div class="w-20 h-20 bg-brand/10 text-brand rounded-2xl flex items-center justify-center text-4xl mx-auto mb-6">🎓</div>
        <h1 class="text-3xl font-extrabold text-slate-800 mb-2">{{ $quiz->nama_quiz }}</h1>
        <p class="text-slate-500 font-medium mb-8">Jenis Latihan: <span class="text-brand font-bold">{{ $quiz->latihan->nama_latihan ?? 'Campuran' }}</span></p>
        
        <div class="bg-slate-50 rounded-2xl p-6 mb-8 text-left border border-slate-100">
            <h3 class="font-bold text-slate-700 mb-3">Informasi Quiz:</h3>
            <ul class="text-sm text-slate-500 space-y-3 font-medium">
                <li class="flex gap-2"><span>✅</span> Terdiri dari 5 soal acak yang telah disiapkan dosenmu.</li>
                <li class="flex gap-2"><span>✅</span> Kerjakan secara berurutan, tidak bisa kembali ke soal sebelumnya.</li>
                <li class="flex gap-2"><span>✅</span> Dapatkan XP dan Skor untuk setiap jawaban yang benar!</li>
            </ul>
        </div>

        <form action="{{ route('quiz.start', $quiz->slug) }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-brand text-white font-extrabold py-4 rounded-2xl shadow-lg shadow-brand/20 hover:scale-[1.02] active:scale-95 transition-all">
                Mulai Kerjakan Quiz
            </button>
        </form>
        <a href="{{ route('dashboard') }}" class="block mt-6 text-slate-400 font-bold text-sm hover:text-brand transition-colors">Kembali ke Dashboard</a>
    </div>
</body>
</html>