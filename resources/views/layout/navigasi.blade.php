{{-- SIDEBAR KIRI --}}
<aside class="w-64 shrink-0 bg-white border-r border-slate-100 flex flex-col sticky top-0 h-screen z-50">
    <!-- Logo -->
    <div class="p-8 flex items-center gap-3">
        <div class="w-10 h-10 bg-brand rounded-xl flex items-center justify-center text-white shadow-lg shadow-brand/20">
            <span class="text-xl">✨</span>
        </div>
        <span class="text-2xl font-black text-brand tracking-tight">THINKARA</span>
    </div>

    <!-- Navigasi -->
    <nav class="flex-1 px-4 space-y-8 overflow-y-auto">
        {{-- Menu Utama --}}
        <div>
            <p class="px-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Menu Utama</p>
            <ul class="space-y-1">
                <li>
                    <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 transition-all {{ request()->is('dashboard*') ? 'bg-brand/10 text-brand rounded-xl font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-brand rounded-xl font-semibold' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        <span class="text-sm">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/leaderboard" class="flex items-center gap-3 px-4 py-3 transition-all {{ request()->is('leaderboard*') ? 'bg-brand/10 text-brand rounded-xl font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-brand rounded-xl font-semibold' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                        <span class="text-sm">Peringkat</span>
                    </a>
                </li>
                <li>
                    <a href="/arena" class="flex items-center gap-3 px-4 py-3 transition-all {{ request()->is('arena*') ? 'bg-brand/10 text-brand rounded-xl font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-brand rounded-xl font-semibold' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path></svg>
                        <span class="text-sm">Arena Latihan</span>
                    </a>
                </li>
            </ul>
        </div>

        {{-- Pengaturan --}}
        <div>
            <p class="px-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Pengaturan</p>
            <ul class="space-y-1">
                <li>
                    <a href="/profil" class="flex items-center gap-3 px-4 py-3 transition-all {{ request()->is('profil*') ? 'bg-brand/10 text-brand rounded-xl font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-brand rounded-xl font-semibold' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span class="text-sm">Profilku</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Logout -->
    <div class="p-6 border-t border-slate-50">
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-500 font-bold hover:bg-red-50 rounded-xl transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span class="text-sm">Keluar</span>
            </button>
        </form>
    </div>
</aside>

{{-- KONTEN KANAN (HEADER + ISI HALAMAN) --}}
<div class="flex flex-col flex-1 min-w-0">
    {{-- Header --}}
    <header class="glass-nav sticky top-0 z-40 h-24 flex items-center justify-between px-10 lg:px-12 border-b border-slate-100/50">
        <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">
            @yield('page_title', 'Ringkasan Belajar')
        </h1>

        <div class="flex items-center gap-8">
            <button class="relative p-2.5 text-slate-400 hover:text-brand transition-all hover:bg-slate-50 rounded-full">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                <span class="absolute top-2.5 right-3 w-2 h-2 bg-accent rounded-full border-2 border-white"></span>
            </button>

            <div class="flex items-center gap-4 pl-8 border-l border-slate-200">
                <div class="w-10 h-10 rounded-full overflow-hidden border border-slate-200">
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=rac" alt="User" class="w-full h-full object-cover bg-slate-50">
                </div>
                <div class="flex flex-col">
                    <span class="text-sm font-extrabold text-slate-800">rac</span>
                    <span class="text-[11px] font-bold text-slate-400">Siswa</span>
                </div>
            </div>
        </div>
    </header>

    {{-- Render Isi Konten --}}
    <main class="p-8 md:p-10 flex-1 overflow-y-auto">
        @yield('content')
    </main>
</div>