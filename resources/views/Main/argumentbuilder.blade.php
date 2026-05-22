@extends('layout.app')
@section('page_title', 'Argument Builder')

@section('content')
<div id="argument-builder-page" data-soal-id="{{ $soal->id_soal }}" class="max-w-6xl mx-auto pb-10">
    {{-- Back Button --}}
    <a href="/arena" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-slate-600 mb-4 transition-colors">
        <span>←</span> Kembali
    </a>

    {{-- Header Banner --}}
    <div class="bg-[#7c3aed] rounded-3xl p-8 lg:p-10 text-white mb-8 shadow-sm">
        <h2 class="text-3xl font-black mb-3 tracking-tight">Topik : {{ $soal->topik }}</h2>
        <p class="text-white/80 text-sm font-semibold">Drag item ke kotak kiri. Klik item di kotak kiri untuk mengembalikannya.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        {{-- KOLOM KIRI: Drop Zones & Button --}}
        <div class="lg:col-span-4 flex flex-col gap-6">
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex-1 space-y-5">
                
                {{-- Claim --}}
                <div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-[#7c3aed] mb-2 block">CLAIM</span>
                    <div class="builder-drop-zone border-2 border-dashed border-slate-200 rounded-2xl min-h-[4rem] p-2 flex items-center justify-center bg-slate-50/50 transition-colors">
                        <span class="text-xs font-bold text-slate-300 placeholder pointer-events-none">Kosong</span>
                    </div>
                </div>

                {{-- Evidence --}}
                <div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-[#3b82f6] mb-2 block">EVIDENCE</span>
                    <div class="builder-drop-zone border-2 border-dashed border-slate-200 rounded-2xl min-h-[4rem] p-2 flex items-center justify-center bg-slate-50/50 transition-colors">
                        <span class="text-xs font-bold text-slate-300 placeholder pointer-events-none">Kosong</span>
                    </div>
                </div>

                {{-- Reasoning --}}
                <div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-[#22c55e] mb-2 block">REASONING</span>
                    <div class="builder-drop-zone border-2 border-dashed border-slate-200 rounded-2xl min-h-[4rem] p-2 flex items-center justify-center bg-slate-50/50 transition-colors">
                        <span class="text-xs font-bold text-slate-300 placeholder pointer-events-none">Kosong</span>
                    </div>
                </div>

                {{-- Reference --}}
                <div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-[#f59e0b] mb-2 block">REFERENCE</span>
                    <div class="builder-drop-zone border-2 border-dashed border-slate-200 rounded-2xl min-h-[4rem] p-2 flex items-center justify-center bg-slate-50/50 transition-colors">
                        <span class="text-xs font-bold text-slate-300 placeholder pointer-events-none">Kosong</span>
                    </div>
                </div>

            </div>

            {{-- Tombol Kirim --}}
            <button id="kirim-argument-builder" class="w-full bg-[#7c3aed] text-white font-black py-4 rounded-2xl text-lg hover:bg-[#6d28d9] transition-all shadow-sm">
                Kirim
            </button>
        </div>

        {{-- KOLOM KANAN: Teks Referensi & Pilihan Jawaban --}}
        <div class="lg:col-span-8 flex flex-col gap-6">
            
            {{-- Teks Studi Kasus --}}
            <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm border-l-4 border-l-[#f472b6]">
                <p class="text-sm font-bold text-slate-700 leading-loose">
                    "{{ $soal->isi_soal }}"
                </p>
            </div>

            {{-- Pilihan Jawaban Draggable --}}
            <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm flex-1">
                <h3 class="text-sm font-black text-slate-800 mb-6">Pilihan Jawaban</h3>
                <div id="pilihan-jawaban-container" class="flex flex-wrap gap-3 min-h-[4rem] items-start content-start">
                    @foreach($items as $item)
                        <div data-id="{{ $item->id_item_builder }}" class="choice-item border border-slate-200 bg-white rounded-xl px-5 py-3 text-xs font-bold text-slate-500 cursor-grab hover:border-[#7c3aed] hover:text-[#7c3aed] transition-colors shadow-sm">{{ $item->isi_item }}</div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>
</div>
@endsection