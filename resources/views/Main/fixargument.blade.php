@extends('layout.app')
@section('page_title', 'Fix The Argument')

@section('content')
<div class="max-w-5xl mx-auto pb-10">
    {{-- Back Button --}}
    <a href="/arena" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-slate-600 mb-4 transition-colors">
        <span>←</span> Kembali
    </a>

    {{-- Header Banner --}}
    <div class="bg-[#7c3aed] rounded-3xl p-8 lg:p-10 text-white mb-6 shadow-sm">
        <h2 class="text-3xl font-black mb-3 tracking-tight">Topik : Multitasking dan Kinerja Kognitif</h2>
        <p class="text-white/80 text-sm font-semibold">Pilih jawaban yang menurutmu paling benar berdasarkan pilihan yang ada.</p>
    </div>

    {{-- Teks Awal --}}
    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm mb-6">
        <p class="text-sm font-bold text-slate-700 leading-loose">
            "Berdasarkan rujukan Ophir et al. (2009), hambatan otak dalam memproses transisi fokus secara instan memicu kegagalan kognitif yang didukung oleh temuan studi Stanford bahwa pelakunya mudah terdistraksi, sehingga terbukti bahwa multitasking merusak kinerja."
        </p>
    </div>

    {{-- Area Perbaikan --}}
    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm mb-6 min-h-[250px]">
        <h3 class="text-sm font-black text-slate-800 mb-8">Perbaiki argumen diatas!</h3>
        
        {{-- Garis Input (Visual Only) --}}
        <div class="space-y-10 mt-4">
            <div class="border-b border-slate-300 w-full h-1"></div>
            <div class="border-b border-slate-300 w-full h-1"></div>
            <div class="border-b border-slate-300 w-full h-1"></div>
            <div class="border-b border-slate-300 w-full h-1"></div>
            <div class="border-b border-slate-300 w-full h-1"></div>
        </div>
    </div>

    {{-- Footer: Pilihan Jawaban & Tombol Kirim --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="md:col-span-3 bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
            <h3 class="text-xs font-black text-slate-800 mb-4">Pilihan Jawaban</h3>
            <div class="flex flex-wrap gap-3">
                <div class="border border-slate-200 rounded-xl px-4 py-2 text-[11px] font-bold text-slate-500 cursor-pointer hover:border-[#7c3aed] hover:text-[#7c3aed] transition-colors shadow-sm">karena studi Stanford membuktikan pelakunya lebih mudah terdistraksi</div>
                <div class="border border-slate-200 rounded-xl px-4 py-2 text-[11px] font-bold text-slate-500 cursor-pointer hover:border-[#7c3aed] hover:text-[#7c3aed] transition-colors shadow-sm">Ophir et al., 2009</div>
                <div class="border border-slate-200 rounded-xl px-4 py-2 text-[11px] font-bold text-slate-500 cursor-pointer hover:border-[#7c3aed] hover:text-[#7c3aed] transition-colors shadow-sm">akibat kegagalan otak memproses transisi fokus secara instan</div>
                <div class="border border-slate-200 rounded-xl px-4 py-2 text-[11px] font-bold text-slate-500 cursor-pointer hover:border-[#7c3aed] hover:text-[#7c3aed] transition-colors shadow-sm">multitasking merusak kinerja kognitif</div>
                <div class="border border-slate-200 rounded-xl px-4 py-2 text-[11px] font-bold text-slate-500 cursor-pointer hover:border-[#7c3aed] hover:text-[#7c3aed] transition-colors shadow-sm">akibat otak manusia memiliki kapasitas penyimpanan memori yang tidak terbatas</div>
            </div>
        </div>
        
        <div class="md:col-span-1">
            <button class="w-full h-[72px] bg-[#7c3aed] text-white font-black rounded-3xl text-lg hover:bg-[#6d28d9] transition-all shadow-sm">
                Kirim
            </button>
        </div>
    </div>
</div>
@endsection