<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Quiz | THINKARA</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-slate-700 flex min-h-screen font-nunito items-center justify-center p-6">
    <div class="w-full max-w-lg bg-white p-10 rounded-[2.5rem] shadow-xl border border-slate-50 text-center relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-brand/5 to-accent/5 pointer-events-none"></div>
        
        <div class="relative z-10">
            <div class="w-24 h-24 bg-gradient-to-br from-brand to-accent text-white rounded-3xl flex items-center justify-center text-5xl mx-auto mb-6 shadow-xl transform rotate-3">🏆</div>
            <h1 class="text-4xl font-extrabold text-slate-800 mb-2">Quiz Selesai!</h1>
            <p class="text-slate-500 font-medium mb-8">Kerja bagus! Berikut adalah perolehan total dari sesi quiz ini.</p>
            
            <div class="grid grid-cols-2 gap-4 mb-8">
                <div class="bg-brand/10 p-6 rounded-2xl border border-brand/20">
                    <p class="text-xs font-bold text-brand uppercase tracking-wider mb-1">Total Skor</p>
                    <p class="text-3xl font-black text-brand">{{ $score }}</p>
                </div>
                <div class="bg-accent/10 p-6 rounded-2xl border border-accent/20">
                    <p class="text-xs font-bold text-accent uppercase tracking-wider mb-1">Total XP</p>
                    <p class="text-3xl font-black text-accent">{{ $xp }}</p>
                </div>
            </div>

            <a href="{{ route('dashboard') }}" class="block w-full bg-slate-800 text-white font-extrabold py-4 rounded-2xl shadow-lg shadow-slate-800/20 hover:scale-[1.02] active:scale-95 transition-all">
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</body>
</html>