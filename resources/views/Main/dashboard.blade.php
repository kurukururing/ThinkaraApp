@extends('layout.app')
@section('page_title', 'Ringkasan Belajar')
@section('content')
<div class="max-w-5xl mx-auto space-y-8">
    {{-- Banner Utama --}}
    <div class="bg-brand rounded-[2rem] p-10 text-white shadow-lg relative overflow-hidden">
        <span class="bg-white/20 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-4 inline-block">Langkah Pertama</span>

        {{-- PERUBAHAN DI SINI: Mengambil username dari user yang login --}}
        <h2 class="text-3xl font-extrabold mb-3">Halo, {{ Auth::user()->username }}! Siap mengasah logikamu hari ini?</h2>

        <p class="text-white/80 text-sm mb-6 max-w-lg">Perjalananmu menjadi pemikir kritis yang mandiri dimulai di sini. Selesaikan misi pertamamu untuk mendapatkan XP dan naik level.</p>
        <a href="{{ route('arena') }}" class="inline-block bg-white text-brand px-6 py-2.5 rounded-full font-bold text-sm hover:bg-slate-50 transition">
            Mulai Latihan Dasar
        </a>
    </div>

    {{-- Statistik --}}
    <div>
        <h3 class="text-base font-extrabold text-slate-800 mb-4">Statistik Kamu</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white p-5 rounded-2xl flex items-center gap-4 border border-slate-100">
                <div class="w-10 h-10 bg-brand/10 rounded-lg flex items-center justify-center text-brand text-lg">📊</div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Level Saat Ini</p>
                    <p class="text-lg font-black text-slate-700">{{ $badge }} <span class="text-xs font-normal text-slate-400">(Lv. {{ $level }})</span></p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-2xl flex items-center gap-4 border border-slate-100">
                <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center text-green-500 text-lg">🟢</div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total XP</p>
                    <p class="text-lg font-black text-slate-700">{{ $totalXp }}</p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-2xl flex items-center gap-4 border border-slate-100">
                <div class="w-10 h-10 bg-orange-50 rounded-lg flex items-center justify-center text-orange-500 text-lg">🔥</div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Latihan Dikerjakan</p>
                    <p class="text-lg font-black text-slate-700">{{ $totalDikerjakan }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Rekomendasi Latihan --}}
    <div>
        <div class="flex justify-between items-end mb-4">
            <div>
                <h3 class="text-base font-extrabold text-slate-800">Rekomendasi Latihan Pertamamu</h3>
                <p class="text-xs text-slate-500">Buka kunci kemampuan analisismu dengan modul dasar ini.</p>
            </div>
            <a href="/arena" class="text-sm font-bold text-brand hover:underline">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-100 flex flex-col h-full">
                <div class="w-8 h-8 bg-slate-100 rounded-md flex items-center justify-center mb-4 text-slate-600">🔧</div>
                <h4 class="font-bold text-slate-800 mb-2">Argument Builder</h4>
                <p class="text-xs text-slate-500 mb-6 flex-1">Susun blok-blok premis dan kesimpulan yang acak menjadi satu kesatuan argumen yang valid.</p>
                <button class="w-full bg-brand/30 text-brand font-bold py-2.5 rounded-xl hover:bg-brand hover:text-white transition">Mulai</button>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-100 flex flex-col h-full">
                <div class="w-8 h-8 bg-slate-100 rounded-md flex items-center justify-center mb-4 text-slate-600">✨</div>
                <h4 class="font-bold text-slate-800 mb-2">Fallacy Finder</h4>
                <p class="text-xs text-slate-500 mb-6 flex-1">Deteksi letak kecacatan logika (Logical Fallacy) yang tersembunyi pada sebuah studi kasus.</p>
                <button class="w-full bg-brand/30 text-brand font-bold py-2.5 rounded-xl hover:bg-brand hover:text-white transition">Mulai</button>
            </div>
        </div>
    </div>
    
</div>
@endsection
