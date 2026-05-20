<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | THINKARA</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-slate-700 flex min-h-screen font-nunito">

    {{-- Sisi Kiri: Branding --}}
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

    {{-- Sisi Kanan: Form Login --}}
    <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-6 sm:p-12 relative bg-white lg:bg-transparent">
        <a href="/" class="absolute top-8 left-8 flex items-center text-slate-400 hover:text-brand font-bold transition-colors text-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>

        <div class="w-full max-w-md bg-white p-10 rounded-[2.5rem] soft-shadow border border-slate-50">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-extrabold text-slate-800 mb-2">Masuk Akun</h2>
                <p class="text-slate-500 font-medium text-sm">Silakan masukkan detail akun Anda.</p>
            </div>

            {{-- Pesan Error Validasi Global --}}
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-600 rounded-2xl text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2 ml-1">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" class="w-full px-5 py-4 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none focus:border-brand focus:bg-white transition-all text-sm" placeholder="Masukkan username Anda" required>
                </div>
                <div>
                    <div class="flex justify-between items-center mb-2 ml-1">
                        <label class="block text-xs font-bold text-slate-700">Password</label>
                        <a href="#" class="text-[11px] text-brand font-bold hover:underline">Lupa Password?</a>
                    </div>
                    <input type="password" name="password" class="w-full px-5 py-4 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none focus:border-brand focus:bg-white transition-all text-sm" placeholder="••••••••" required>
                </div>
                
                {{-- PERBAIKAN: Tombol dipastikan bertipe submit agar memicu route POST --}}
                <button type="submit" class="w-full bg-primary text-white font-extrabold py-4 rounded-2xl shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all mt-4">
                    Masuk
                </button>

                <p class="text-center text-slate-500 text-[13px] mt-8">
                    Belum punya akun? <a href="/register" class="text-accent font-bold hover:underline ml-1">Daftar sekarang</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>