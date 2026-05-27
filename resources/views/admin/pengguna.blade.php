<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna - Thinkara Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-[#F8F9FE] text-slate-800 font-sans antialiased flex h-screen overflow-hidden">
    
    <!-- Sidebar -->
    <aside class="w-72 bg-white border-r border-slate-100 flex flex-col shrink-0 hidden md:flex shadow-[4px_0_24px_rgba(0,0,0,0.02)] z-20">
        <div class="h-20 flex items-center px-8 border-b border-slate-50">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-[#7c3aed] to-[#d946ef] flex items-center justify-center text-white shadow-lg shadow-[#7c3aed]/20 font-black text-lg">T</div>
                <span class="text-2xl font-black text-slate-800 tracking-tight">Thinkara<span class="text-[#7c3aed]">.</span></span>
            </div>
        </div>
        <div class="px-8 py-6 flex-1 overflow-y-auto">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Menu Utama</p>
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl text-slate-500 hover:bg-slate-50 hover:text-[#7c3aed] font-semibold transition-all hover:scale-[1.02]">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Dashboard
                </a>
                <a href="{{ route('admin.soal') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl text-slate-500 hover:bg-slate-50 hover:text-[#7c3aed] font-semibold transition-all hover:scale-[1.02]">
                    <i data-lucide="book-open" class="w-5 h-5"></i> Manajemen Soal
                </a>
                <a href="{{ route('admin.pengguna') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl bg-[#7c3aed] text-white font-bold shadow-md shadow-[#7c3aed]/20 transition-all hover:-translate-y-0.5">
                    <i data-lucide="users" class="w-5 h-5"></i> Pengguna
                </a>
            </nav>
        </div>
        <div class="mt-auto p-6 border-t border-slate-50">
            <div class="flex items-center gap-3 px-4 py-3 mb-4 rounded-2xl border border-slate-100 bg-slate-50/50">
                <div class="w-10 h-10 rounded-full bg-[#7c3aed]/10 flex items-center justify-center text-[#7c3aed] font-bold shrink-0">
                    <i data-lucide="shield-check" class="w-5 h-5"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-bold text-slate-800 truncate">Administrator</p>
                    <p class="text-xs font-semibold text-slate-400 truncate">Sistem Thinkara</p>
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
        <!-- Header -->
        <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-100 flex items-center px-10 justify-between shrink-0 z-10 sticky top-0">
            <div>
                <h1 class="text-2xl font-black text-slate-800 tracking-tight">Manajemen Pengguna</h1>
                <p class="text-sm font-semibold text-slate-500">Daftar mahasiswa yang terdaftar di sistem</p>
            </div>
        </header>

        <!-- Scrollable Table Area -->
        <div class="flex-1 overflow-y-auto p-10">
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap md:whitespace-normal">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100 text-xs uppercase tracking-wider font-bold text-slate-400">
                                <th class="p-5 px-6 w-32">NPM</th>
                                <th class="p-5 px-6">Nama Lengkap</th>
                                <th class="p-5 px-6">Username</th>
                                <th class="p-5 px-6">Email</th>
                                <th class="p-5 px-6">Instansi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                            @forelse($pengguna as $p)
                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="p-5 px-6 font-bold text-slate-400">{{ $p->npm ?? '-' }}</td>
                                    <td class="p-5 px-6 font-semibold text-slate-900">{{ $p->nama_mahasiswa }}</td>
                                    <td class="p-5 px-6">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-slate-100 text-slate-600">
                                            <i data-lucide="at-sign" class="w-3.5 h-3.5"></i> {{ $p->akun->username ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="p-5 px-6 text-slate-500 font-medium">{{ $p->akun->email ?? '-' }}</td>
                                    <td class="p-5 px-6 text-slate-500 font-medium">{{ $p->instansi ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-12 text-center text-slate-400 font-medium flex flex-col items-center gap-4">
                                        <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center text-slate-300 mb-2">
                                            <i data-lucide="users" class="w-8 h-8"></i>
                                        </div>
                                        Belum ada pengguna terdaftar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Inisialisasi Icon -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>