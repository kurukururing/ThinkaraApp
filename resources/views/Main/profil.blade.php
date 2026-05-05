@extends('layout.app')
@section('page_title', 'Pengaturan Profil')

@section('content')
<div class="max-w-5xl mx-auto space-y-6 pb-10">

    {{-- Header Profil --}}
    <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm">
        {{-- Cover Banner Ungu --}}
        <div class="h-32 bg-[#7c3aed] w-full"></div>
        
        <div class="px-8 pb-6 relative flex flex-col md:flex-row md:justify-between md:items-end gap-6">
            <div class="flex items-end gap-5 -mt-12">
                {{-- Foto Profil --}}
                <div class="w-24 h-24 rounded-full border-4 border-white overflow-hidden bg-slate-100 shadow-sm shrink-0">
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Jeff" alt="Profil" class="w-full h-full object-cover">
                </div>
                <div class="pb-1">
                    <h2 class="text-2xl font-black text-slate-800 tracking-tight leading-none mb-1">Jeff</h2>
                    <p class="text-[#7c3aed] font-bold text-sm mb-1">@Jeff</p>
                    <p class="text-[11px] text-slate-500 font-semibold">Mahasiswa | Bergabung 02 May 2026</p>
                </div>
            </div>
            
            <button class="bg-[#f5f3ff] text-[#7c3aed] font-bold px-6 py-2.5 rounded-xl text-sm hover:bg-[#7c3aed] hover:text-white transition-all shadow-sm">
                Bagikan Profil
            </button>
        </div>
    </div>

    {{-- Grid Konten Bawah (2 Kolom di Desktop) --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- KOLOM KIRI: Form Edit Profil (Mengambil 2 bagian grid) --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Informasi Pribadi --}}
            <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                <h3 class="text-lg font-black text-slate-800 mb-6 tracking-tight">Informasi Pribadi</h3>
                <form class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Nama Lengkap</label>
                            <input type="text" value="Gregorius Frederick Jefferson" class="w-full border border-slate-200 rounded-xl px-5 py-3 text-sm font-semibold text-slate-700 focus:border-[#7c3aed] focus:ring-2 focus:ring-[#7c3aed]/20 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Username</label>
                            <input type="text" value="Jeff" class="w-full border border-slate-200 rounded-xl px-5 py-3 text-sm font-semibold text-slate-700 focus:border-[#7c3aed] focus:ring-2 focus:ring-[#7c3aed]/20 outline-none transition-all">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Email</label>
                        <input type="email" value="jeff@gmail.com" class="w-full border border-slate-200 rounded-xl px-5 py-3 text-sm font-semibold text-slate-700 focus:border-[#7c3aed] focus:ring-2 focus:ring-[#7c3aed]/20 outline-none transition-all">
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Jenjang</label>
                            <input type="text" placeholder="-" class="w-full border border-slate-200 rounded-xl px-5 py-3 text-sm font-semibold text-slate-700 focus:border-[#7c3aed] outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Tanggal Lahir</label>
                            <input type="text" placeholder="-" class="w-full border border-slate-200 rounded-xl px-5 py-3 text-sm font-semibold text-slate-700 focus:border-[#7c3aed] outline-none transition-all">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Jenis Kelamin</label>
                            <input type="text" placeholder="-" class="w-full border border-slate-200 rounded-xl px-5 py-3 text-sm font-semibold text-slate-700 focus:border-[#7c3aed] outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Institusi</label>
                            <input type="text" placeholder="-" class="w-full border border-slate-200 rounded-xl px-5 py-3 text-sm font-semibold text-slate-700 focus:border-[#7c3aed] outline-none transition-all">
                        </div>
                    </div>

                    <div class="text-right pt-2">
                        <button class="bg-[#7c3aed] text-white font-bold px-8 py-3 rounded-xl text-sm shadow-sm hover:bg-[#6d28d9] transition-all">Simpan</button>
                    </div>
                </form>
            </div>

            {{-- Keamanan Akun --}}
            <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                <h3 class="text-lg font-black text-slate-800 mb-6 tracking-tight">Keamanan Akun</h3>
                <form class="space-y-5">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Password Saat Ini</label>
                        <input type="password" value="********" class="w-full border border-slate-200 rounded-xl px-5 py-3 text-sm font-semibold text-slate-700 focus:border-[#7c3aed] focus:ring-2 focus:ring-[#7c3aed]/20 outline-none transition-all">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Password Baru</label>
                            <input type="password" placeholder="Masukan Password Baru" class="w-full border border-slate-200 rounded-xl px-5 py-3 text-sm font-semibold text-slate-700 focus:border-[#7c3aed] focus:ring-2 focus:ring-[#7c3aed]/20 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Konfirmasi Password</label>
                            <input type="password" placeholder="Ulangi Password Baru" class="w-full border border-slate-200 rounded-xl px-5 py-3 text-sm font-semibold text-slate-700 focus:border-[#7c3aed] focus:ring-2 focus:ring-[#7c3aed]/20 outline-none transition-all">
                        </div>
                    </div>
                    <div class="text-right pt-2">
                        <button class="bg-[#7c3aed] text-white font-bold px-8 py-3 rounded-xl text-sm shadow-sm hover:bg-[#6d28d9] transition-all">Perbarui Password</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- KOLOM KANAN: Widget (Mengambil 1 bagian grid) --}}
        <div class="space-y-6">
            
            {{-- Lencana Saya --}}
            <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                <h3 class="text-lg font-black text-slate-800 mb-5 tracking-tight">Lencana Saya</h3>
                <div class="flex flex-wrap gap-4">
                    <div class="w-20 h-20 bg-[#fff1f2] rounded-2xl flex flex-col items-center justify-center border border-[#ffe4e6] shadow-sm">
                        <span class="text-2xl mb-1">🔥</span>
                        <span class="text-[9px] font-black uppercase tracking-wider text-[#be123c]">Streak 5h</span>
                    </div>
                    <div class="w-20 h-20 bg-[#eff6ff] rounded-2xl flex flex-col items-center justify-center border border-[#dbeafe] shadow-sm">
                        <span class="text-2xl mb-1">⏩</span>
                        <span class="text-[9px] font-black uppercase tracking-wider text-[#1d4ed8]">Cepat</span>
                    </div>
                    <div class="w-20 h-20 bg-[#f5f3ff] rounded-2xl flex flex-col items-center justify-center border border-[#ede9fe] shadow-sm">
                        <span class="text-2xl mb-1">🎯</span>
                        <span class="text-[9px] font-black uppercase tracking-wider text-[#6d28d9]">Akurat</span>
                    </div>
                </div>
            </div>

            {{-- Status Akun --}}
            <div class="bg-[#7c3aed] p-8 rounded-3xl text-white shadow-md relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="font-black text-white/70 text-[10px] uppercase tracking-widest mb-2">Status Akun</h3>
                    <p class="text-2xl font-black mb-3 tracking-tight">Pemikir Pro</p>
                    <p class="text-sm text-white/90 mb-6 font-medium leading-relaxed">Kamu memiliki akses penuh ke semua modul latihan dan analisis tingkat lanjut.</p>
                    <button class="w-full bg-white text-[#7c3aed] font-black py-3.5 rounded-xl text-sm shadow-sm hover:bg-slate-50 transition-all">Kelola Langganan</button>
                </div>
            </div>

            {{-- Zona Berbahaya --}}
            <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                <h3 class="text-lg font-black text-slate-800 mb-5 tracking-tight">Zona Berbahaya</h3>
                <button class="w-full bg-[#fff1f2] text-[#e11d48] font-black py-3.5 rounded-xl text-sm flex justify-between items-center px-5 mb-3 border border-[#ffe4e6] hover:bg-[#ffe4e6] transition-all">
                    Keluar dari Akun 
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
                <button class="w-full text-slate-400 font-bold py-2 text-[11px] uppercase tracking-wider text-left px-2 hover:text-[#e11d48] transition-all">
                    Hapus Akun Permanen
                </button>
            </div>

        </div>
    </div>
</div>
@endsection