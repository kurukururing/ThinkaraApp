@extends('layou.app')
@section('page_title', 'Tantangan Harian')

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

    {{-- Kotak Tantangan & Timer --}}
    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm mb-6">
        <div class="flex justify-between items-center mb-8 border-b border-slate-50 pb-4">
            <h3 class="text-sm font-black text-slate-800">Tantangan Harian</h3>
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold text-slate-500">Time Remaining :</span>
                <span class="bg-[#7c3aed] text-white text-xs font-black px-4 py-1.5 rounded-lg shadow-sm">5 : 00</span>
            </div>
        </div>
        
        <div class="space-y-6 text-sm font-bold text-slate-700 leading-loose">
            <p>"Melakukan banyak hal sekaligus sebenarnya bukan benar-benar multitasking, melainkan <span class="inline-block w-32 border-b-2 border-slate-300 mx-2"></span> tugas secara cepat yang dapat menurunkan fokus."</p>
            <p>"Beban <span class="inline-block w-24 border-b-2 border-slate-300 mx-2"></span> yang berlebihan saat multitasking sering kali menyebabkan peningkatan jumlah kesalahan atau eror."</p>
            <p>"Terlalu sering berpindah fokus antar tugas dapat mengurangi <span class="inline-block w-32 border-b-2 border-slate-300 mx-2"></span> kerja hingga 40%."</p>
        </div>
    </div>

    {{-- Pilihan Jawaban --}}
    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm mb-6">
        <h3 class="text-sm font-black text-slate-800 mb-6">Pilihan Jawaban</h3>
        <div class="flex flex-wrap gap-4">
            <div class="border border-slate-200 rounded-xl px-8 py-2 text-xs font-bold text-slate-400 cursor-pointer hover:border-[#7c3aed] hover:text-[#7c3aed] transition-colors shadow-sm">terutama</div>
            <div class="border border-slate-200 rounded-xl px-8 py-2 text-xs font-bold text-slate-400 cursor-pointer hover:border-[#7c3aed] hover:text-[#7c3aed] transition-colors shadow-sm">jika</div>
            <div class="border border-slate-200 rounded-xl px-12 py-2 text-xs font-bold text-slate-400 cursor-pointer hover:border-[#7c3aed] hover:text-[#7c3aed] transition-colors shadow-sm">perpindahan</div>
            <div class="border border-slate-200 rounded-xl px-12 py-2 text-xs font-bold text-slate-400 cursor-pointer hover:border-[#7c3aed] hover:text-[#7c3aed] transition-colors shadow-sm">dianggap</div>
            <div class="border border-slate-200 rounded-xl px-10 py-2 text-xs font-bold text-slate-400 cursor-pointer hover:border-[#7c3aed] hover:text-[#7c3aed] transition-colors shadow-sm">efisien</div>
            <div class="border border-slate-200 rounded-xl px-10 py-2 text-xs font-bold text-slate-400 cursor-pointer hover:border-[#7c3aed] hover:text-[#7c3aed] transition-colors shadow-sm">akan</div>
            <div class="border border-slate-200 rounded-xl px-10 py-2 text-xs font-bold text-slate-400 cursor-pointer hover:border-[#7c3aed] hover:text-[#7c3aed] transition-colors shadow-sm">melakukan</div>
            <div class="border border-slate-200 rounded-xl px-10 py-2 text-xs font-bold text-slate-400 cursor-pointer hover:border-[#7c3aed] hover:text-[#7c3aed] transition-colors shadow-sm">kognitif</div>
            <div class="border border-slate-200 rounded-xl px-10 py-2 text-xs font-bold text-slate-400 cursor-pointer hover:border-[#7c3aed] hover:text-[#7c3aed] transition-colors shadow-sm">harus</div>
        </div>
    </div>

    {{-- Tombol Kirim --}}
    <button class="w-full bg-[#7c3aed] text-white font-black py-4 rounded-2xl text-lg hover:bg-[#6d28d9] transition-all shadow-sm">
        Kirim
    </button>
</div>
@endsection