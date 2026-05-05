@extends('layout.app')
@section('page_title', 'Argument Builder')

@section('content')
<div class="max-w-6xl mx-auto pb-10">
    {{-- Back Button --}}
    <a href="/arena" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-slate-600 mb-4 transition-colors">
        <span>←</span> Kembali
    </a>

    {{-- Header Banner --}}
    <div class="bg-[#7c3aed] rounded-3xl p-8 lg:p-10 text-white mb-8 shadow-sm">
        <h2 class="text-3xl font-black mb-3 tracking-tight">Topik : Multitasking dan Kinerja Kognitif</h2>
        <p class="text-white/80 text-sm font-semibold">Drag item ke kotak kiri. Klik item di kotak kiri untuk mengembalikannya.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        {{-- KOLOM KIRI: Drop Zones & Button --}}
        <div class="lg:col-span-4 flex flex-col gap-6">
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex-1 space-y-5">
                
                {{-- Claim --}}
                <div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-[#7c3aed] mb-2 block">CLAIM</span>
                    <div class="border-2 border-dashed border-slate-200 rounded-2xl h-16 flex items-center justify-center bg-slate-50/50">
                        <span class="text-xs font-bold text-slate-300">Kosong</span>
                    </div>
                </div>

                {{-- Evidence --}}
                <div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-[#3b82f6] mb-2 block">EVIDENCE</span>
                    <div class="border-2 border-dashed border-slate-200 rounded-2xl h-16 flex items-center justify-center bg-slate-50/50">
                        <span class="text-xs font-bold text-slate-300">Kosong</span>
                    </div>
                </div>

                {{-- Reasoning --}}
                <div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-[#22c55e] mb-2 block">REASONING</span>
                    <div class="border-2 border-dashed border-slate-200 rounded-2xl h-16 flex items-center justify-center bg-slate-50/50">
                        <span class="text-xs font-bold text-slate-300">Kosong</span>
                    </div>
                </div>

                {{-- Reference --}}
                <div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-[#f59e0b] mb-2 block">REFERENCE</span>
                    <div class="border-2 border-dashed border-slate-200 rounded-2xl h-16 flex items-center justify-center bg-slate-50/50">
                        <span class="text-xs font-bold text-slate-300">Kosong</span>
                    </div>
                </div>

            </div>

            {{-- Tombol Kirim --}}
            <button class="w-full bg-[#7c3aed] text-white font-black py-4 rounded-2xl text-lg hover:bg-[#6d28d9] transition-all shadow-sm">
                Kirim
            </button>
        </div>

        {{-- KOLOM KANAN: Teks Referensi & Pilihan Jawaban --}}
        <div class="lg:col-span-8 flex flex-col gap-6">
            
            {{-- Teks Studi Kasus --}}
            <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm border-l-4 border-l-[#f472b6]">
                <p class="text-sm font-bold text-slate-700 leading-loose">
                    "Multitasking sering dianggap sebagai kemampuan yang meningkatkan produktivitas, terutama dalam lingkungan digital yang serba cepat. Namun, penelitian dalam bidang kognitif menunjukkan bahwa otak manusia memiliki keterbatasan dalam memproses beberapa tugas kompleks secara bersamaan. Ketika seseorang mencoba melakukan multitasking, sebenarnya terjadi peralihan fokus yang cepat antar tugas, yang justru dapat menurunkan efisiensi dan meningkatkan tingkat kesalahan. Dampak ini menjadi lebih signifikan ketika tugas yang dilakukan membutuhkan konsentrasi tinggi."
                </p>
            </div>

            {{-- Pilihan Jawaban Draggable --}}
            <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm flex-1">
                <h3 class="text-sm font-black text-slate-800 mb-6">Pilihan Jawaban</h3>
                <div class="flex flex-wrap gap-3">
                    <div class="border border-slate-200 rounded-xl px-5 py-3 text-xs font-bold text-slate-500 cursor-grab hover:border-[#7c3aed] hover:text-[#7c3aed] transition-colors shadow-sm">Peralihan Fokus Menurunkan Efisiensi</div>
                    <div class="border border-slate-200 rounded-xl px-5 py-3 text-xs font-bold text-slate-500 cursor-grab hover:border-[#7c3aed] hover:text-[#7c3aed] transition-colors shadow-sm">Multitasking menurunkan kinerja</div>
                    <div class="border border-slate-200 rounded-xl px-5 py-3 text-xs font-bold text-slate-500 cursor-grab hover:border-[#7c3aed] hover:text-[#7c3aed] transition-colors shadow-sm">Otak terbatas memproses banyak tugas</div>
                    <div class="border border-slate-200 rounded-xl px-5 py-3 text-xs font-bold text-slate-500 cursor-grab hover:border-[#7c3aed] hover:text-[#7c3aed] transition-colors shadow-sm">Produktivitas itu penting</div>
                    <div class="border border-slate-200 rounded-xl px-5 py-3 text-xs font-bold text-slate-500 cursor-grab hover:border-[#7c3aed] hover:text-[#7c3aed] transition-colors shadow-sm">Penelitian Kognitif</div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection