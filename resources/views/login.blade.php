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
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="username" class="block text-xs font-bold text-slate-700 mb-2 ml-1">Username</label>
                    <input id="username" type="text" name="username" value="{{ old('username') }}" class="w-full px-5 py-4 rounded-2xl border @error('username') border-red-300 @else border-slate-100 @enderror bg-slate-50/50 outline-none focus:border-brand focus:bg-white transition-all text-sm" placeholder="Masukkan username Anda" required autofocus>
                    @error('username') <p class="text-red-500 text-xs mt-1.5 ml-1">{{ $message }}</p> @enderror
                </div>
                <div class="relative">
                    <label for="password" class="block text-xs font-bold text-slate-700 mb-2 ml-1">Password</label>
                    <input id="password" type="password" name="password" class="w-full px-5 py-4 rounded-2xl border @error('password') border-red-300 @else border-slate-100 @enderror bg-slate-50/50 outline-none focus:border-brand focus:bg-white transition-all text-sm" placeholder="••••••••" required>
                    <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-0 top-7 px-4 text-slate-400 hover:text-brand">
                        <svg id="eye-icon-password" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        <svg id="eye-off-icon-password" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 .847 0 1.67.127 2.456.371M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 2l20 20"></path></svg>
                    </button>
                    @error('password') <p class="text-red-500 text-xs mt-1.5 ml-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="flex items-center justify-between !mt-4">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-brand focus:ring-brand/50">
                        <label for="remember" class="ml-2 block text-sm text-slate-600 font-bold">Ingat saya</label>
                    </div>
                    <a href="#" class="text-xs text-brand font-bold hover:underline">Lupa Password?</a>
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

    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            const eyeIcon = document.getElementById('eye-icon-' + id);
            const eyeOffIcon = document.getElementById('eye-off-icon-' + id);

            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeOffIcon.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeOffIcon.classList.add('hidden');
            }
        }
    </script>
</body>
</html>