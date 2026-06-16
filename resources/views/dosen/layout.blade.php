<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dosen Panel - Thinkara</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-surface text-slate-800 font-sans antialiased flex h-screen overflow-hidden">

    <!-- Sidebar Dosen -->
    <aside class="w-72 bg-white border-r border-slate-100 flex flex-col shrink-0 hidden md:flex shadow-[4px_0_24px_rgba(0,0,0,0.02)] z-20">
        {{-- Logo --}}
        <div class="h-20 flex items-center px-8 border-b border-slate-50">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-brand to-accent flex items-center justify-center text-white shadow-lg shadow-brand/20 font-black text-lg">T</div>
                <span class="text-2xl font-black text-slate-800 tracking-tight">Thinkara<span class="text-brand">.</span></span>
            </div>
        </div>

        {{-- Nav --}}
        <div class="px-8 py-6 flex-1 overflow-y-auto">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Menu</p>
            <nav class="space-y-2">
                <a href="{{ route('dosen.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3.5 rounded-2xl font-bold transition-all
                       {{ request()->routeIs('dosen.dashboard')
                           ? 'bg-brand text-white shadow-md shadow-brand/20 hover:-translate-y-0.5'
                           : 'text-slate-500 hover:bg-slate-50 hover:text-brand hover:scale-[1.02]' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    Manajemen Quiz
                </a>
            </nav>
        </div>

        {{-- User info + logout --}}
        <div class="mt-auto p-6 border-t border-slate-50">
            <div class="flex items-center gap-3 px-4 py-3 mb-4 rounded-2xl border border-slate-100 bg-slate-50/50">
                <div class="w-10 h-10 rounded-full bg-brand/10 flex items-center justify-center text-brand font-bold shrink-0">
                    <i data-lucide="user" class="w-5 h-5"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->username }}</p>
                    <p class="text-xs font-semibold text-slate-400 truncate">Dosen</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center justify-center gap-2 px-4 py-3 w-full rounded-2xl text-red-500 hover:bg-red-50 hover:text-red-600 font-bold transition-all border border-transparent hover:border-red-100">
                    <i data-lucide="log-out" class="w-4 h-4"></i> Keluar Sesi
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        {{-- Header --}}
        <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-100 flex items-center px-10 justify-between shrink-0 z-10 sticky top-0">
            <div>
                <h1 class="text-2xl font-black text-slate-800 tracking-tight">@yield('page_title', 'Dosen Panel')</h1>
            </div>
            <div class="hidden md:flex items-center gap-2 px-4 py-2 bg-slate-50 rounded-xl border border-slate-100 text-sm font-semibold text-slate-500">
                <i data-lucide="calendar" class="w-4 h-4 text-brand"></i>
                {{ now()->locale('id')->isoFormat('D MMM Y') }}
            </div>
        </header>

        {{-- Scrollable content --}}
        <div class="flex-1 overflow-y-auto p-10">
            @yield('content')
        </div>
    </main>

    <script>lucide.createIcons();</script>
</body>
</html>