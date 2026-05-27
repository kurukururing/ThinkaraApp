<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembahasan - Thinkara</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen text-slate-800 font-sans antialiased py-10">
    <div class="max-w-3xl mx-auto px-6">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <!-- Header Status -->
            <div class="p-8 text-center border-b border-slate-200 {{ $pembahasanData['is_correct'] ? 'bg-green-50' : 'bg-red-50' }}">
                <h1 class="text-3xl font-bold {{ $pembahasanData['is_correct'] ? 'text-green-600' : 'text-red-500' }}">
                    {{ $pembahasanData['is_correct'] ? 'Berhasil!' : 'Belum Tepat!' }}
                </h1>
                <p class="mt-4 text-lg font-medium text-slate-700">{{ $pembahasanData['message'] }}</p>
                
                <!-- Skor, XP, Durasi -->
                <div class="mt-6 flex flex-wrap justify-center gap-4">
                    <div class="bg-white px-6 py-3 rounded-xl border {{ $pembahasanData['is_correct'] ? 'border-green-200 text-green-700' : 'border-red-200 text-red-700' }} shadow-sm flex flex-col items-center">
                        <span class="text-[10px] font-black uppercase tracking-widest opacity-70 mb-1">Skor Didapat</span>
                        <span class="text-xl font-black">+{{ $pembahasanData['skor'] ?? 0 }}</span>
                    </div>
                    <div class="bg-white px-6 py-3 rounded-xl border {{ $pembahasanData['is_correct'] ? 'border-green-200 text-green-700' : 'border-red-200 text-red-700' }} shadow-sm flex flex-col items-center">
                        <span class="text-[10px] font-black uppercase tracking-widest opacity-70 mb-1">XP Didapat</span>
                        <span class="text-xl font-black">+{{ $pembahasanData['xp'] ?? 0 }}</span>
                    </div>
                    <div class="bg-white px-6 py-3 rounded-xl border {{ $pembahasanData['is_correct'] ? 'border-green-200 text-green-700' : 'border-red-200 text-red-700' }} shadow-sm flex flex-col items-center">
                        <span class="text-[10px] font-black uppercase tracking-widest opacity-70 mb-1">Durasi</span>
                        <span class="text-xl font-black">
                            @if(isset($pembahasanData['durasi']) && $pembahasanData['durasi'] >= 60)
                                {{ floor($pembahasanData['durasi'] / 60) }}m {{ $pembahasanData['durasi'] % 60 }}s
                            @else
                                {{ $pembahasanData['durasi'] ?? 0 }}s
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Konten Pembahasan -->
            <div class="p-8">
                <h2 class="text-xl font-bold mb-4 text-slate-800">Soal: {{ $soal->topik }}</h2>
                <div class="text-slate-600 mb-8 p-5 bg-slate-50 rounded-xl border border-slate-100 leading-relaxed">
                    {{ $soal->isi_soal }}
                </div>
                
                <!-- Kunci Jawaban -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold mb-4 text-indigo-600 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Kunci Jawaban
                    </h3>
                    
                    @if(in_array($pembahasanData['type'], ['argumentbuilder', 'fixargument']) && $kunciBuilder)
                        <div class="space-y-3">
                            @foreach($kunciBuilder as $kunci)
                                <div class="p-4 bg-indigo-50 border border-indigo-100 rounded-xl">
                                    <span class="text-xs font-bold uppercase tracking-wider text-indigo-500 mb-1 block">{{ $kunci->tipe }}</span>
                                    <p class="font-medium text-slate-700">{{ $kunci->isi_item }}</p>
                                </div>
                            @endforeach
                        </div>
                    @elseif($pembahasanData['type'] === 'fallacy' && $kunciFallacy)
                        <div class="p-4 bg-indigo-50 border border-indigo-100 rounded-xl">
                            <span class="text-xs font-bold uppercase tracking-wider text-indigo-500 mb-1 block">Jenis Kesalahan Logika</span>
                            <p class="font-medium text-slate-700">{{ $kunciFallacy->jenis_kesalahan }}</p>
                        </div>
                    @elseif($pembahasanData['type'] === 'qte' && $kunciQte)
                        <div class="p-4 bg-indigo-50 border border-indigo-100 rounded-xl">
                            <span class="text-xs font-bold uppercase tracking-wider text-indigo-500 mb-1 block">Jawaban Tepat</span>
                            <p class="font-medium text-slate-700">{{ $kunciQte->isi_item }}</p>
                        </div>
                    @endif
                </div>

                <!-- Penjelasan -->
                <div>
                    <h3 class="text-lg font-bold mb-4 text-emerald-600 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Penjelasan
                    </h3>
                    <div class="p-5 bg-emerald-50 border border-emerald-100 rounded-xl text-slate-700 leading-relaxed font-medium">
                        {{ $soal->penjelasan ?? 'Tidak ada penjelasan tambahan untuk soal ini.' }}
                    </div>
                </div>
                
                <!-- Tombol Kembali -->
                <div class="mt-10 pt-6 border-t border-slate-100 text-center">
                    <a href="{{ route('arena') }}" class="inline-flex items-center justify-center px-8 py-3.5 text-base font-semibold text-white transition-all duration-200 bg-indigo-600 border border-transparent rounded-xl hover:bg-indigo-700 shadow-sm hover:shadow-md focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                        Kembali ke Arena
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>