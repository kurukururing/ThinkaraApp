<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembahasan Quiz | THINKARA</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-slate-700 flex flex-col min-h-screen font-nunito p-6">
    <div class="max-w-3xl mx-auto w-full mt-10">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-extrabold text-slate-800">Soal {{ $urutan }} dari {{ $totalSoal }}</h2>
            <span class="px-4 py-1 rounded-full text-xs font-bold {{ $pembahasanData['is_correct'] ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                {{ $pembahasanData['is_correct'] ? 'Benar' : 'Salah' }} (+{{ $pembahasanData['skor'] }} Skor)
            </span>
        </div>

        <div class="bg-white p-8 rounded-[2rem] shadow-lg border border-slate-50 mb-6">
            <div class="text-center mb-6">
                <div class="text-4xl mb-4">{{ $pembahasanData['is_correct'] ? '🎉' : '💡' }}</div>
                <h1 class="text-2xl font-extrabold text-slate-800 mb-2">{{ $pembahasanData['message'] }}</h1>
            </div>

            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 mb-6">
                <h3 class="font-bold text-slate-700 mb-2">Penjelasan:</h3>
                <p class="text-slate-600 text-sm leading-relaxed">{{ $soal->penjelasan }}</p>
            </div>

            @if($pembahasanData['type'] == 'argumentbuilder' || $pembahasanData['type'] == 'fixargument')
                <div class="space-y-3">
                    <h3 class="font-bold text-slate-700 mb-3">Susunan Argumen yang Benar:</h3>
                    @foreach($kunciBuilder as $kunci)
                        <div class="p-3 bg-white border border-slate-200 rounded-xl text-sm shadow-sm flex items-start gap-3">
                            <span class="uppercase text-[10px] font-bold px-2 py-1 rounded-md bg-brand/10 text-brand shrink-0">{{ $kunci->tipe }}</span>
                            <span class="text-slate-600 font-medium">{{ $kunci->isi_item }}</span>
                        </div>
                    @endforeach
                </div>
            @elseif($pembahasanData['type'] == 'fallacy')
                <div class="p-4 bg-white border border-slate-200 rounded-xl text-sm shadow-sm">
                    <h3 class="font-bold text-slate-700 mb-1">Cacat Logika yang Tepat:</h3>
                    <p class="text-brand font-bold text-lg">{{ $kunciFallacy->jenis_kesalahan ?? '-' }}</p>
                </div>
            @elseif($pembahasanData['type'] == 'qte')
                <div class="p-4 bg-white border border-slate-200 rounded-xl text-sm shadow-sm">
                    <h3 class="font-bold text-slate-700 mb-1">Jawaban yang Tepat:</h3>
                    <p class="text-brand font-bold text-lg">{{ $kunciQte->isi_item ?? '-' }}</p>
                </div>
            @endif
        </div>

        <div class="flex justify-end">
            <a href="{{ $nextUrl }}" class="bg-brand text-white font-extrabold py-3 px-8 rounded-2xl shadow-lg hover:scale-[1.02] active:scale-95 transition-all">
                {{ $hasNext ? 'Lanjut ke Soal Berikutnya' : 'Lihat Hasil Akhir' }} &rarr;
            </a>
        </div>
        
        <!-- Spacer untuk layar -->
        <div class="h-10"></div>
    </div>
</body>
</html>