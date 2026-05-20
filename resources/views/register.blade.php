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

    {{-- Sisi Kiri: Branding --}}
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-brand via-brand-dark to-accent relative overflow-hidden items-center justify-center p-12">
        <div class="absolute top-0 left-0 w-full h-full bg-white/5 opacity-50 backdrop-blur-3xl skew-y-6 transform -translate-y-1/2"></div>
        <div class="relative z-10 text-white max-w-lg text-center lg:text-left">
            <span class="text-5xl font-extrabold flex items-center gap-3 mb-6">
                <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center text-3xl backdrop-blur-md">✨</div>
                THINKARA.
            </span>
            <h1 class="text-4xl font-extrabold mb-4 leading-tight">Mulai Logika Baru!</h1>
            <p class="text-lg font-medium opacity-90 leading-relaxed">Daftarkan dirimu dan asah kemampuan analisis kritis sekarang.</p>
        </div>
    </div>

    {{-- Sisi Kanan: Form Signup --}}
    <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-6 sm:p-12 relative bg-white lg:bg-transparent">
        <a href="/" class="absolute top-8 left-8 flex items-center text-slate-400 hover:text-brand font-bold transition-colors text-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>

        <div class="w-full max-w-lg bg-white p-8 sm:p-10 rounded-[2.5rem] soft-shadow border border-slate-50 my-12">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-slate-800 mb-2">Buat Akun Baru</h2>
                <p class="text-slate-500 font-medium text-sm">Lengkapi data secara bertahap.</p>
            </div>

            {{-- Indikator Step dengan jarak renggang (mb-10) --}}
            <div class="flex items-center justify-center gap-3 mb-10 text-xs font-bold uppercase tracking-wider">
                <div id="badge-step1" class="px-4 py-2 rounded-xl bg-brand text-white shadow-sm transition-all">1. Data Akun</div>
                <div class="w-8 h-[2px] bg-slate-200"></div>
                <div id="badge-step2" class="px-4 py-2 rounded-xl bg-slate-100 text-slate-400 transition-all">2. Data Diri</div>
            </div>

            {{-- Tampilan Error Validasi Laravel --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-2xl text-sm">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST" class="space-y-6">
                @csrf
                
                {{-- STEP 1: DATA LOGIN AKUN --}}
                <div id="step1" class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2.5 ml-1">Username</label>
                        <input type="text" name="username" value="{{ old('username') }}" class="w-full px-5 py-4 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none focus:border-brand focus:bg-white transition-all text-sm" placeholder="Username unik" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2.5 ml-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full px-5 py-4 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none focus:border-brand focus:bg-white transition-all text-sm" placeholder="nama@email.com" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2.5 ml-1">Password</label>
                        <input type="password" name="password" class="w-full px-5 py-4 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none focus:border-brand focus:bg-white transition-all text-sm" placeholder="Minimal 6 karakter" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2.5 ml-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="w-full px-5 py-4 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none focus:border-brand focus:bg-white transition-all text-sm" placeholder="Ulangi password" required>
                    </div>
                    
                    <button type="button" onclick="nextStep()" class="w-full bg-slate-800 text-white font-extrabold py-4 rounded-2xl hover:scale-[1.01] active:scale-95 transition-all mt-6 flex items-center justify-center gap-2 shadow-lg shadow-slate-800/10">
                        Lanjut Langkah Ke-2
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>

                {{-- STEP 2: DATA MAHASISWA --}}
                <div id="step2" class="space-y-6 hidden">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2.5 ml-1">Nama Lengkap</label>
                        <input type="text" name="nama_mahasiswa" value="{{ old('nama_mahasiswa') }}" class="w-full px-5 py-4 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none focus:border-brand focus:bg-white transition-all text-sm" placeholder="Nama Lengkap Mahasiswa" required>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2.5 ml-1">NPM</label>
                            <input id="npmInput" type="text" name="npm" maxlength="11" value="{{ old('npm') }}" class="w-full px-5 py-4 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none focus:border-brand focus:bg-white transition-all text-sm" placeholder="11 digit angka" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2.5 ml-1">Jenjang</label>
                            <input type="text" name="jenjang" value="{{ old('jenjang') }}" class="w-full px-5 py-4 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none focus:border-brand focus:bg-white transition-all text-sm" placeholder="S1 / D3" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2.5 ml-1">Jenis Kelamin</label>
                            <div class="relative">
                                <select name="jenis_kelamin" class="w-full px-5 py-4 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none focus:border-brand focus:bg-white transition-all text-sm appearance-none" required>
                                    <option value="">Pilih</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-5 text-slate-400">
                                    <svg class="fill-current h-4 w-4" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2.5 ml-1">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full px-5 py-4 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none focus:border-brand focus:bg-white transition-all text-sm" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2.5 ml-1">Instansi / Universitas</label>
                        <input type="text" name="instansi" value="{{ old('instansi') }}" class="w-full px-5 py-4 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none focus:border-brand focus:bg-white transition-all text-sm" placeholder="Nama asal universitas" required>
                    </div>
                    
                    <div class="flex gap-4 pt-4">
                        <button type="button" onclick="prevStep()" class="w-1/3 border border-slate-200 text-slate-600 font-bold py-4 rounded-2xl hover:bg-slate-50 active:scale-95 transition-all">
                            Kembali
                        </button>
                        {{-- PERBAIKAN: Tombol dipastikan bertipe submit untuk mendaftarkan form --}}
                        <button type="submit" class="w-2/3 bg-gradient-to-r from-brand to-accent text-white font-extrabold py-4 rounded-2xl shadow-lg shadow-brand/20 hover:scale-[1.01] active:scale-95 transition-all">
                            Buat Akun Anda
                        </button>
                    </div>
                </div>
                
                <p class="text-center text-slate-500 text-[13px] pt-4">
                    Sudah punya akun? <a href="/login" class="text-brand font-bold hover:underline ml-1">Masuk di sini</a>
                </p>
            </form>
        </div>
    </div>

    {{-- Script Navigasi Form Step --}}
    <script>
        function nextStep() {
            document.getElementById('step1').classList.add('hidden');
            document.getElementById('step2').classList.remove('hidden');
            
            document.getElementById('badge-step1').classList.replace('bg-brand', 'bg-slate-100');
            document.getElementById('badge-step1').classList.replace('text-white', 'text-slate-400');
            
            document.getElementById('badge-step2').classList.replace('bg-slate-100', 'bg-brand');
            document.getElementById('badge-step2').classList.replace('text-slate-400', 'text-white');
        }

        function prevStep() {
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step1').classList.remove('hidden');
            
            document.getElementById('badge-step2').classList.replace('bg-brand', 'bg-slate-100');
            document.getElementById('badge-step2').classList.replace('text-white', 'text-slate-400');
            
            document.getElementById('badge-step1').classList.replace('bg-slate-100', 'bg-brand');
            document.getElementById('badge-step1').classList.replace('text-slate-400', 'text-white');
        }

        @if ($errors->has('npm') || $errors->has('nama_mahasiswa') || $errors->has('instansi') || $errors->has('tanggal_lahir'))
            nextStep();
        @endif
    </script>
</body>
</html>