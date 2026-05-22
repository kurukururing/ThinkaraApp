@extends('layout.app')
@section('page_title', 'Tantangan Harian')

@section('content')
<div class="max-w-5xl mx-auto pb-10" id="gamified-qte-page" data-soal-id="{{ $soal->id_soal ?? '' }}">
    {{-- Back Button --}}
    <a href="/arena" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-slate-600 mb-4 transition-colors">
        <span>←</span> Kembali
    </a>

    {{-- Header Banner --}}
    <div class="bg-[#7c3aed] rounded-3xl p-8 lg:p-10 text-white mb-6 shadow-sm">
        <h2 class="text-3xl font-black mb-3 tracking-tight">Topik : {{ $soal->topik ?? 'Tantangan QTE' }}</h2>
        <p class="text-white/80 text-sm font-semibold">Tarik (drag) jawaban yang benar ke bagian yang kosong dengan cepat!</p>
    </div>

    {{-- Kotak Tantangan & Timer --}}
    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm mb-6">
        <div class="flex justify-between items-center mb-8 border-b border-slate-50 pb-4">
            <h3 class="text-sm font-black text-slate-800">Tantangan Kecepatan</h3>
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold text-slate-500">Time Remaining :</span>
                <span id="qte-timer" class="bg-[#7c3aed] text-white text-xs font-black px-4 py-1.5 rounded-lg shadow-sm">10 : 00</span>
            </div>
        </div>
        
        <div class="space-y-6 text-sm font-bold text-slate-700 leading-loose text-center">
            @php
                $isiSoal = $soal->isi_soal ?? 'Teks studi kasus belum tersedia saat ini.';
                // Mengakomodasi soal dengan token "[blank]" maupun soal biasa tanpa "[blank]"
                if(str_contains($isiSoal, '[blank]')) {
                    $isiSoal = str_replace('[blank]', '<span class="qte-drop-zone inline-flex items-center justify-center min-w-[150px] min-h-[40px] border-b-4 border-slate-300 mx-2 align-middle bg-slate-50 rounded-lg shadow-inner transition-all"></span>', $isiSoal);
                } else {
                    $isiSoal .= '<br><br><span class="qte-drop-zone inline-flex items-center justify-center min-w-[200px] min-h-[50px] border-b-4 border-[#7c3aed]/40 mx-2 align-middle bg-slate-50 rounded-lg shadow-inner transition-all"></span>';
                }
            @endphp
            <p>{!! $isiSoal !!}</p>
        </div>
    </div>

    {{-- Pilihan Jawaban --}}
    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm mb-6">
        <h3 class="text-sm font-black text-slate-800 mb-6 text-center">Pilihan Jawaban</h3>
        <div id="qte-pilihan-container" class="flex flex-wrap justify-center items-center gap-4 min-h-[100px] p-6 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl transition-all">
            @if(isset($opsiQte) && $opsiQte->count() > 0)
                @foreach($opsiQte as $opsi)
                    <div class="qte-choice-item border border-slate-200 bg-white rounded-xl px-8 py-3 text-sm font-bold text-slate-600 hover:border-[#7c3aed] hover:text-[#7c3aed] shadow-sm cursor-grab transition-all" data-id="{{ $opsi->id_item_qte }}" draggable="true">
                        {{ $opsi->isi_item }}
                    </div>
                @endforeach
            @else
                <p class="col-span-2 text-center text-slate-500">Pilihan jawaban untuk soal ini belum tersedia.</p>
            @endif
        </div>
    </div>

    {{-- Tombol Kirim --}}
    <button id="kirim-gamified-qte" class="w-full bg-[#7c3aed] text-white font-black py-4 rounded-2xl text-lg hover:bg-[#6d28d9] transition-all shadow-sm">
        Kirim
    </button>
</div>
@endsection