<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Thinkara</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Load icon modern dari Lucide -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-[#F8F9FE] text-slate-800 font-sans antialiased flex h-screen overflow-hidden">
    
    <!-- Sidebar Admin -->
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
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl bg-[#7c3aed] text-white font-bold shadow-md shadow-[#7c3aed]/20 transition-all hover:-translate-y-0.5">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Dashboard
                </a>
                <a href="{{ route('admin.soal') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl text-slate-500 hover:bg-slate-50 hover:text-[#7c3aed] font-semibold transition-all hover:scale-[1.02]">
                    <i data-lucide="book-open" class="w-5 h-5"></i> Manajemen Soal
                </a>
                <a href="{{ route('admin.pengguna') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl text-slate-500 hover:bg-slate-50 hover:text-[#7c3aed] font-semibold transition-all hover:scale-[1.02]">
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
                <h1 class="text-2xl font-black text-slate-800 tracking-tight">Beranda Admin</h1>
                <p class="text-sm font-semibold text-slate-500">Ringkasan aktivitas dan data sistem</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="hidden md:flex items-center gap-2 px-4 py-2 bg-slate-50 rounded-xl border border-slate-100 text-sm font-semibold text-slate-500">
                    <i data-lucide="calendar" class="w-4 h-4 text-[#7c3aed]"></i>
                    {{ now()->format('d M Y') }}
                </div>
            </div>
        </header>

        <!-- Scrollable Area -->
        <div class="flex-1 overflow-y-auto p-10">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-[#7c3aed] to-[#d946ef] rounded-[2rem] p-10 mb-10 text-white shadow-lg shadow-[#7c3aed]/20 relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-3xl font-black mb-3">Selamat Datang, Admin! 👋</h2>
                    <p class="text-white/90 font-medium max-w-2xl text-lg leading-relaxed">Pantau perkembangan pembelajaran mahasiswa dan kelola materi latihan dengan mudah melalui dashboard ini.</p>
                </div>
                <div class="absolute -right-10 -top-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute right-20 -bottom-20 w-48 h-48 bg-white/10 rounded-full blur-2xl"></div>
            </div>

            <!-- Stat Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
                <div class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm hover:shadow-md transition-all group relative overflow-hidden">
                    <div class="absolute -right-6 -top-6 w-32 h-32 bg-blue-50/50 rounded-full group-hover:scale-150 transition-transform duration-700 ease-out"></div>
                    <div class="relative z-10 flex items-center gap-6">
                        <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center shrink-0 shadow-inner group-hover:bg-blue-500 group-hover:text-white transition-colors duration-300">
                            <i data-lucide="users" class="w-8 h-8"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Total Pengguna</p>
                            <h3 class="text-4xl font-black text-slate-800">{{ $totalPengguna }}</h3>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm hover:shadow-md transition-all group relative overflow-hidden">
                    <div class="absolute -right-6 -top-6 w-32 h-32 bg-[#7c3aed]/5 rounded-full group-hover:scale-150 transition-transform duration-700 ease-out"></div>
                    <div class="relative z-10 flex items-center gap-6">
                        <div class="w-16 h-16 rounded-2xl bg-[#7c3aed]/10 text-[#7c3aed] flex items-center justify-center shrink-0 shadow-inner group-hover:bg-[#7c3aed] group-hover:text-white transition-colors duration-300">
                            <i data-lucide="book-open" class="w-8 h-8"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Total Soal</p>
                            <h3 class="text-4xl font-black text-slate-800">{{ $totalSoal }}</h3>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm hover:shadow-md transition-all group relative overflow-hidden">
                    <div class="absolute -right-6 -top-6 w-32 h-32 bg-orange-50/50 rounded-full group-hover:scale-150 transition-transform duration-700 ease-out"></div>
                    <div class="relative z-10 flex items-center gap-6">
                        <div class="w-16 h-16 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center shrink-0 shadow-inner group-hover:bg-orange-500 group-hover:text-white transition-colors duration-300">
                            <i data-lucide="gamepad-2" class="w-8 h-8"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Total Sesi Latihan</p>
                            <h3 class="text-4xl font-black text-slate-800">{{ $totalSesi }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Area -->
            <div class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm mb-10">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-black text-slate-800">Aktivitas Latihan (7 Hari Terakhir)</h3>
                        <p class="text-sm font-semibold text-slate-500">Statistik jumlah sesi latihan yang diselesaikan oleh mahasiswa setiap harinya.</p>
                    </div>
                </div>
                <div class="h-80">
                    <canvas id="aktivitasChart"></canvas>
                </div>
            </div>

            <!-- Additional Charts -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                <div class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm">
                    <div class="mb-6">
                        <h3 class="text-xl font-black text-slate-800">Distribusi Kategori Latihan</h3>
                        <p class="text-sm font-semibold text-slate-500">Komposisi pengerjaan berdasarkan jenis latihan.</p>
                    </div>
                    <div class="h-64 relative flex justify-center">
                        <canvas id="kategoriSesiChart"></canvas>
                    </div>
                </div>
                <div class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm">
                    <div class="mb-6">
                        <h3 class="text-xl font-black text-slate-800">Top 5 Instansi</h3>
                        <p class="text-sm font-semibold text-slate-500">Asal instansi dengan pengguna terbanyak.</p>
                    </div>
                    <div class="h-64 relative">
                        <canvas id="instansiChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Inisialisasi Icon -->
    <script>
        lucide.createIcons();

        const ctx = document.getElementById('aktivitasChart').getContext('2d');
        const labels = {!! $statistikSesi->pluck('tanggal')->toJson() !!};
        const data = {!! $statistikSesi->pluck('total')->toJson() !!};

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Sesi Latihan',
                    data: data,
                    borderColor: '#7c3aed',
                    backgroundColor: 'rgba(124, 58, 237, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#7c3aed',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            font: { family: 'inherit' },
                            color: '#94a3b8'
                        },
                        grid: { color: '#f1f5f9', drawBorder: false }
                    },
                    x: {
                        ticks: {
                            font: { family: 'inherit' },
                            color: '#94a3b8'
                        },
                        grid: { display: false, drawBorder: false }
                    }
                },
                interaction: { intersect: false, mode: 'index' },
            }
        });

        // Doughnut Chart: Distribusi Kategori Latihan
        const ctxKategori = document.getElementById('kategoriSesiChart').getContext('2d');
        const labelKategori = {!! $distribusiSesi->keys()->toJson() !!};
        const dataKategori = {!! $distribusiSesi->values()->toJson() !!};

        new Chart(ctxKategori, {
            type: 'doughnut',
            data: {
                labels: labelKategori,
                datasets: [{
                    data: dataKategori,
                    backgroundColor: ['#7c3aed', '#d946ef', '#3b82f6', '#f97316', '#10b981'],
                    borderWidth: 0,
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { font: { family: 'inherit' }, usePointStyle: true, padding: 20 } }
                },
                cutout: '70%'
            }
        });

        // Bar Chart: Top 5 Instansi
        const ctxInstansi = document.getElementById('instansiChart').getContext('2d');
        const labelInstansi = {!! $distribusiInstansi->keys()->toJson() !!};
        const dataInstansi = {!! $distribusiInstansi->values()->toJson() !!};

        new Chart(ctxInstansi, {
            type: 'bar',
            data: {
                labels: labelInstansi,
                datasets: [{
                    label: 'Jumlah Pengguna',
                    data: dataInstansi,
                    backgroundColor: 'rgba(59, 130, 246, 0.85)',
                    borderRadius: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f1f5f9', drawBorder: false }, ticks: { stepSize: 1, font: {family: 'inherit'}, color: '#94a3b8' } },
                    x: { grid: { display: false, drawBorder: false }, ticks: { font: {family: 'inherit'}, color: '#94a3b8' } }
                }
            }
        });
    </script>
</body>
</html>