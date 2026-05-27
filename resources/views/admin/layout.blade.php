<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Thinkara</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 flex h-screen font-sans">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col">
        <div class="h-16 flex items-center px-6 border-b border-slate-200">
            <h1 class="text-xl font-bold text-[#7c3aed]">Admin Panel</h1>
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-[#7c3aed]/10 text-[#7c3aed] font-semibold' : 'text-slate-600 hover:bg-slate-100' }}">Dashboard</a>
            <a href="{{ route('admin.pengguna') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.pengguna') ? 'bg-[#7c3aed]/10 text-[#7c3aed] font-semibold' : 'text-slate-600 hover:bg-slate-100' }}">Manajemen Pengguna</a>
            <a href="{{ route('admin.soal') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.soal') ? 'bg-[#7c3aed]/10 text-[#7c3aed] font-semibold' : 'text-slate-600 hover:bg-slate-100' }}">Manajemen Soal</a>
        </nav>
        <div class="p-4 border-t border-slate-200">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-red-600 font-medium hover:bg-red-50 rounded-lg transition-colors">Keluar</button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto p-8">
        @yield('content')
    </main>
</body>
</html>