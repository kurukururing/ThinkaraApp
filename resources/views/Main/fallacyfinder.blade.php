@extends('layout.app')
@section('page_title', 'Fallacy Finder')
@section('content')
<div class="max-w-4xl mx-auto">
    <a href="/arena" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-slate-600 mb-4">
        <span>←</span> Kembali
    </a>

    {{-- Kotak Topik Ungu --}}
    <div class="bg-brand rounded-2xl p-8 text-white mb-6">
        <h2 class="text-2xl font-black mb-2">Topik : Multitasking dan Kinerja Kognitif</h2>
        <p class="text-white/80 text-sm font-medium">Pilih jawaban yang menurutmu paling benar berdasarkan pilihan yang ada.</p>
    </div>

    {{-- Paragraf Studi Kasus --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 mb-6">
        <p class="text-slate-700 text-sm leading-relaxed font-semibold">
            "Multitasking sering dianggap sebagai kemampuan yang meningkatkan produktivitas, terutama dalam lingkungan digital yang serba cepat. Namun, penelitian dalam bidang kognitif menunjukkan bahwa otak manusia memiliki keterbatasan dalam memproses beberapa tugas kompleks secara bersamaan. Ketika seseorang mencoba melakukan multitasking, sebenarnya terjadi peralihan fokus yang cepat antar tugas, yang justru dapat menurunkan efisiensi dan meningkatkan tingkat kesalahan. Dampak ini menjadi lebih signifikan ketika tugas yang dilakukan membutuhkan konsentrasi tinggi."
        </p>
    </div>

    {{-- Pertanyaan --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 mb-6">
        <h3 class="text-sm font-extrabold text-slate-800 mb-2">Pertanyaan</h3>
        <p class="text-slate-600 text-sm font-semibold">Berdasarkan penggalan paragraf diatas, temukan apa tipe kesalahan dari paragraf diatas</p>
    </div>

    {{-- Pilihan Ganda --}}
    <div class="grid grid-cols-2 gap-4 mb-6">
        <button class="bg-white border border-slate-100 py-6 rounded-2xl text-slate-700 font-extrabold hover:border-brand hover:text-brand transition shadow-sm text-center">Ad Hominem</button>
        <button class="bg-white border border-slate-100 py-6 rounded-2xl text-slate-700 font-extrabold hover:border-brand hover:text-brand transition shadow-sm text-center">Straw Man</button>
        <button class="bg-white border border-slate-100 py-6 rounded-2xl text-slate-700 font-extrabold hover:border-brand hover:text-brand transition shadow-sm text-center">False Dilemma</button>
        <button class="bg-white border border-slate-100 py-6 rounded-2xl text-slate-700 font-extrabold hover:border-brand hover:text-brand transition shadow-sm text-center">Circular Reasoning</button>
    </div>

    {{-- Tombol Kirim --}}
    <button class="w-full bg-brand text-white font-bold py-4 rounded-xl text-lg hover:bg-brand-dark transition shadow-md">
        Kirim
    </button>
</div>
@endsection