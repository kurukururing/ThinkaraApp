@extends('layout.app')
@section('page_title', 'Fix The Argument')

@section('content')
<div class="max-w-5xl mx-auto pb-10" id="fix-argument-page" data-soal-id="{{ $soal->id_soal ?? '' }}">
    {{-- Back Button --}}
    <a href="/arena" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-slate-600 mb-4 transition-colors">
        <span>←</span> Kembali
    </a>

    {{-- Header Banner --}}
    <div class="bg-[#7c3aed] rounded-3xl p-8 lg:p-10 text-white mb-6 shadow-sm">
        <h2 class="text-3xl font-black mb-3 tracking-tight">Topik : {{ $soal->topik ?? 'Latihan Argumen' }}</h2>
        <p class="text-white/80 text-sm font-semibold">Pilih jawaban yang menurutmu paling benar berdasarkan pilihan yang ada.</p>
    </div>

    {{-- Teks Awal --}}
    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm mb-6">
        <p class="text-sm font-bold text-slate-700 leading-loose">
            "{{ $soal->isi_soal ?? 'Teks argumen belum tersedia saat ini.' }}"
        </p>
    </div>

    {{-- Area Perbaikan --}}
    <div id="area-perbaikan-container" class="bg-white p-8 rounded-3xl border-2 border-dashed border-slate-200 shadow-sm mb-6 min-h-[250px] flex flex-col gap-3">
        <h3 class="text-sm font-black text-slate-800 mb-8">Perbaiki argumen diatas!</h3>
        {{-- Item jawaban yang dipindahkan akan muncul di sini --}}
        <span class="placeholder text-center text-slate-400 font-semibold">Klik pilihan jawaban di bawah untuk menyusunnya di sini.</span>
    </div>

    {{-- Footer: Pilihan Jawaban & Tombol Kirim --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="md:col-span-3 bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
            <h3 class="text-xs font-black text-slate-800 mb-4">Pilihan Jawaban</h3>
            <div id="pilihan-jawaban-container" class="flex flex-wrap gap-3">
                @if(isset($items) && $items->count() > 0)
                    @foreach($items as $item)
                        {{-- Koreksi: Menggunakan $item->id sebagai primary key dan menambahkan class 'choice-item' untuk JS --}}
                        <div class="choice-item border border-slate-200 rounded-xl px-4 py-2 text-[11px] font-bold text-slate-500 cursor-pointer hover:border-[#7c3aed] hover:text-[#7c3aed] transition-colors shadow-sm" data-id="{{ $item->id_item_builder }}">{{ $item->isi_item }}</div>
                    @endforeach
                @else
                    <p class="text-xs font-bold text-slate-400">Pilihan jawaban belum diatur untuk soal ini.</p>
                @endif
            </div>
        </div>
        
        <div class="md:col-span-1">
            <button id="kirim-fix-argument" class="w-full h-[72px] bg-[#7c3aed] text-white font-black rounded-3xl text-lg hover:bg-[#6d28d9] transition-all shadow-sm">
                Kirim
            </button>
        </div>
    </div>
</div>
@endsection