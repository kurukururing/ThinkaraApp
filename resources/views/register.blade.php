<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | THINKARA</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-slate-700 flex min-h-screen font-nunito">

    {{-- Sisi Kiri: Branding (Tetap konsisten seperti image_03d45b.jpg) --}}
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-brand via-brand-dark to-accent relative overflow-hidden items-center justify-center p-12">
        <div class="absolute top-0 left-0 w-full h-full bg-white/5 opacity-50 backdrop-blur-3xl skew-y-6 transform -translate-y-1/2"></div>
        <div class="relative z-10 text-white max-w-lg text-center lg:text-left">
            <span class="text-5xl font-extrabold flex items-center gap-3 mb-6">
                <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center text-3xl backdrop-blur-md">✨</div>
                THINKARA.
            </span>
            <h1 class="text-4xl font-extrabold mb-4 leading-tight">Selamat Datang Kembali!</h1>
            <p class="text-lg font-medium opacity-90 leading-relaxed">Lanjutkan perjalananmu mengasah logika hari ini.</p>
        </div>
    </div>

    {{-- Sisi Kanan: Form Signup --}}
    <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-6 sm:p-12 relative bg-white lg:bg-transparent">
        <a href="/" class="absolute top-8 left-8 flex items-center text-slate-400 hover:text-brand font-bold transition-colors text-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>

        <div class="w-full max-w-md bg-white p-10 rounded-[2.5rem] soft-shadow border border-slate-50">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-slate-800 mb-2">Buat Akun Baru</h2>
                <p class="text-slate-500 font-medium text-sm">Mulai perjalanan kritis Anda sekarang.</p>
            </div>

            <form class="space-y-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2 ml-1">Username</label>
                    <input type="text" class="w-full px-5 py-3.5 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none focus:border-brand focus:bg-white transition-all text-sm" placeholder="Username">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2 ml-1">Email</label>
                    <input type="email" class="w-full px-5 py-3.5 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none focus:border-brand focus:bg-white transition-all text-sm" placeholder="nama@email.com">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2 ml-1">Password</label>
                    <input type="password" class="w-full px-5 py-3.5 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none focus:border-brand focus:bg-white transition-all text-sm" placeholder="Password">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2 ml-1">NPM</label>
                    <input id="npmInput" type="text" maxlength="11" class="w-full px-5 py-3.5 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none focus:border-brand focus:bg-white transition-all text-sm" placeholder="NPM (Angka)">
                </div>
                
                <button href="/dashboard" class="w-full bg-gradient-to-r from-brand to-accent text-white font-extrabold py-4 rounded-2xl shadow-lg shadow-brand/20 hover:scale-[1.02] active:scale-95 transition-all mt-4">
                    Buat Akun
                </button>
                
                <p class="text-center text-slate-500 text-[13px] mt-8">
                    Sudah punya akun? <a href="/login" class="text-brand font-bold hover:underline ml-1">Masuk di sini</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>