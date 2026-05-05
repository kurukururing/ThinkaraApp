@extends('layout.app')
@section('page_title', 'Papan Peringkat')

@section('content')
<div class="max-w-5xl mx-auto pb-10">

    {{-- Header & Filter --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
        <div>
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Top Thinkers 🏆</h2>
            <p class="text-sm text-slate-500 font-medium mt-1">Data performa berdasarkan pemikiran kritis.</p>
        </div>
        
        <div class="flex flex-col sm:flex-row items-center gap-3">
            <input type="text" placeholder="Cari ..." class="w-full sm:w-56 px-5 py-2.5 bg-white border border-slate-100 rounded-xl text-sm font-semibold text-slate-600 focus:outline-none focus:border-[#7c3aed] focus:ring-1 focus:ring-[#7c3aed] transition-all placeholder:text-slate-400 shadow-sm">
            <button class="px-5 py-2.5 text-sm font-bold bg-white text-slate-600 border border-slate-100 rounded-xl shadow-sm hover:bg-slate-50 transition-all whitespace-nowrap">Waktu Tercepat</button>
            <button class="px-5 py-2.5 text-sm font-bold bg-[#7c3aed] text-white rounded-xl shadow-sm shadow-[#7c3aed]/20 hover:bg-[#6d28d9] transition-all whitespace-nowrap">Waktu Mulai</button>
        </div>
    </div>

    {{-- Tabel Peringkat --}}
    <div class="bg-white rounded-[1.5rem] shadow-sm border border-slate-100 mb-8 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[800px]">
                <thead>
                    <tr class="text-[10px] text-slate-400 font-black uppercase tracking-widest border-b border-slate-50">
                        <th class="py-5 px-8 w-16">#</th>
                        <th class="py-5 px-6">PLAYER</th>
                        <th class="py-5 px-6 text-center">XP</th>
                        <th class="py-5 px-6 text-center">SKOR</th>
                        <th class="py-5 px-6 text-center">WAKTU MULAI</th>
                        <th class="py-5 px-6 text-center">DURASI</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-black text-slate-700">
                    
                    {{-- Peringkat 1 --}}
                    <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                        <td class="py-5 px-8 text-[#eab308] text-lg">1</td>
                        <td class="py-5 px-6 flex items-center gap-4">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=kensi" class="w-10 h-10 rounded-full bg-slate-50">
                            <span class="text-base text-slate-800">kensi</span>
                        </td>
                        <td class="py-5 px-6 text-center text-slate-600">50</td>
                        <td class="py-5 px-6 text-center text-slate-600">25</td>
                        <td class="py-5 px-6 text-center text-slate-400 font-bold">2026-04-19 07:58:37</td>
                        <td class="py-5 px-6 text-center">
                            <span class="bg-[#f5f3ff] text-[#7c3aed] px-4 py-1.5 rounded-lg text-xs font-black">0:05</span>
                        </td>
                    </tr>

                    {{-- Peringkat 2 --}}
                    <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                        <td class="py-5 px-8 text-slate-400 text-lg">2</td>
                        <td class="py-5 px-6 flex items-center gap-4">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Budiman" class="w-10 h-10 rounded-full bg-slate-50">
                            <span class="text-base text-slate-800">Budiman</span>
                        </td>
                        <td class="py-5 px-6 text-center text-slate-600">190</td>
                        <td class="py-5 px-6 text-center text-slate-600">100</td>
                        <td class="py-5 px-6 text-center text-slate-400 font-bold">2026-04-18 21:06:51</td>
                        <td class="py-5 px-6 text-center">
                            <span class="bg-[#f5f3ff] text-[#7c3aed] px-4 py-1.5 rounded-lg text-xs font-black">0:13</span>
                        </td>
                    </tr>

                    {{-- Peringkat 3 --}}
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-5 px-8 text-slate-400 text-lg">3</td>
                        <td class="py-5 px-6 flex items-center gap-4">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Axel" class="w-10 h-10 rounded-full bg-slate-50">
                            <span class="text-base text-slate-800">Axel</span>
                        </td>
                        <td class="py-5 px-6 text-center text-slate-600">160</td>
                        <td class="py-5 px-6 text-center text-slate-600">80</td>
                        <td class="py-5 px-6 text-center text-slate-400 font-bold">2026-04-18 21:05:58</td>
                        <td class="py-5 px-6 text-center">
                            <span class="bg-[#f5f3ff] text-[#7c3aed] px-4 py-1.5 rounded-lg text-xs font-black">0:07</span>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    {{-- Bottom Bar Peringkat Kamu --}}
    <div class="relative bg-[#fbf9ff] border border-[#ede3ff] rounded-2xl p-6 md:px-8 flex flex-col md:flex-row items-center justify-between shadow-sm mt-10">
        
        {{-- Badge Peringkat Kamu --}}
        <div class="absolute -top-3 left-6 bg-[#7c3aed] text-white text-[9px] font-black uppercase tracking-widest px-3 py-1.5 rounded-full shadow-sm">
            PERINGKAT KAMU
        </div>

        <div class="flex items-center gap-6 mt-2 md:mt-0 w-full md:w-auto">
            <span class="text-[#a78bfa] font-black text-xl">-</span>
            <div class="flex items-center gap-4">
                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=rac" class="w-12 h-12 rounded-full bg-white border border-[#ede3ff]">
                <div class="flex flex-col">
                    <span class="text-base font-black text-[#6d28d9] leading-tight">rac</span>
                    <span class="text-[10px] text-[#8b5cf6] font-bold uppercase tracking-widest mt-0.5">PEMULA LV. 1</span>
                </div>
            </div>
        </div>
        
        <div class="flex items-center justify-end gap-12 w-full md:w-auto mt-4 md:mt-0 pr-4">
            <div class="text-center">
                <p class="text-[10px] font-black text-[#a78bfa] uppercase tracking-widest mb-1">SKOR</p>
                <p class="text-xl font-black text-[#6d28d9] leading-none">0</p>
            </div>
            <div class="text-center">
                <p class="text-[10px] font-black text-[#a78bfa] uppercase tracking-widest mb-1">TERCEPAT</p>
                <p class="text-xl font-black text-[#6d28d9] leading-none">--:--</p>
            </div>
        </div>

    </div>

</div>
@endsection