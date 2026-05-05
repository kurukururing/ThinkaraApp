@extends('layout.app')
@section('page_title', 'Arena Latihan')

@section('content')
<div class="max-w-5xl mx-auto pb-10">
    {{-- Header --}}
    <div class="text-center mb-10 mt-4">
        <h2 class="text-3xl font-black text-slate-800 tracking-tight mb-2">Arena Latihan</h2>
        <p class="text-sm font-semibold text-slate-400">Pilih salah satu dari 4 latihan yang tersedia, dan mulai perjalananmu</p>
    </div>

    {{-- Grid Menu Latihan --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        {{-- Card 1 --}}
        <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm flex flex-col">
            <div class="w-10 h-10 bg-[#f5f3ff] rounded-xl flex items-center justify-center mb-5 border border-[#ede9fe]">
                <span class="text-lg">🔧</span>
            </div>
            <h3 class="text-lg font-black text-slate-800 mb-3 tracking-tight">Argument Builder</h3>
            <p class="text-xs font-bold text-slate-400 leading-relaxed mb-8 flex-1">
                Susun blok-blok premis dan kesimpulan yang acak menjadi satu kesatuan argumen yang valid.
            </p>
            <a href="/argumentbuilder" class="block w-full text-center bg-[#c4b5fd] text-white font-bold py-3.5 rounded-xl hover:bg-[#a78bfa] transition-colors shadow-sm">
                Mulai
            </a>
        </div>

        {{-- Card 2 --}}
        <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm flex flex-col">
            <div class="w-10 h-10 bg-[#f5f3ff] rounded-xl flex items-center justify-center mb-5 border border-[#ede9fe]">
                <span class="text-lg">✨</span>
            </div>
            <h3 class="text-lg font-black text-slate-800 mb-3 tracking-tight">Fix The Argument</h3>
            <p class="text-xs font-bold text-slate-400 leading-relaxed mb-8 flex-1">
                Analisis titik kelemahan teks dan perbaiki struktur argumen agar menjadi lebih kokoh.
            </p>
            <a href="/fixargument" class="block w-full text-center bg-[#c4b5fd] text-white font-bold py-3.5 rounded-xl hover:bg-[#a78bfa] transition-colors shadow-sm">
                Mulai
            </a>
        </div>

        {{-- Card 3 --}}
        <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm flex flex-col">
            <div class="w-10 h-10 bg-[#f5f3ff] rounded-xl flex items-center justify-center mb-5 border border-[#ede9fe]">
                <span class="text-lg">🎮</span>
            </div>
            <h3 class="text-lg font-black text-slate-800 mb-3 tracking-tight">Gamified QTE</h3>
            <p class="text-xs font-bold text-slate-400 leading-relaxed mb-8 flex-1">
                Tingkatkan refleks dan kosakata dengan mengetik cepat di bawah tekanan waktu.
            </p>
            <a href="/gamifiedqte" class="block w-full text-center bg-[#c4b5fd] text-white font-bold py-3.5 rounded-xl hover:bg-[#a78bfa] transition-colors shadow-sm">
                Mulai
            </a>
        </div>

        {{-- Card 4 --}}
        <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm flex flex-col">
            <div class="w-10 h-10 bg-[#f5f3ff] rounded-xl flex items-center justify-center mb-5 border border-[#ede9fe]">
                <span class="text-lg">🔍</span>
            </div>
            <h3 class="text-lg font-black text-slate-800 mb-3 tracking-tight">Fallacy Finder</h3>
            <p class="text-xs font-bold text-slate-400 leading-relaxed mb-8 flex-1">
                Analisis titik kelemahan teks dan perbaiki struktur argumen agar menjadi lebih kokoh.
            </p>
            <a href="/fallacyfinder" class="block w-full text-center bg-[#c4b5fd] text-white font-bold py-3.5 rounded-xl hover:bg-[#a78bfa] transition-colors shadow-sm">
                Mulai
            </a>
        </div>

    </div>
</div>
@endsection