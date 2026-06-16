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
                
                <input type="hidden" name="user_role" id="user_role" value="{{ old('user_role', 'mahasiswa') }}">

                {{-- Pilihan Role Pendaftar --}}
                <div class="flex p-1 bg-slate-100 rounded-xl mb-6" id="role-selector">
                    <button type="button" id="tab-mahasiswa" onclick="selectRole('mahasiswa')" class="w-1/2 py-2 text-sm font-bold rounded-lg transition-all">Sebagai Mahasiswa</button>
                    <button type="button" id="tab-dosen" onclick="selectRole('dosen')" class="w-1/2 py-2 text-sm font-bold rounded-lg transition-all">Sebagai Dosen</button>
                </div>

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

                {{-- STEP 2: DATA DIRI MAHASISWA --}}
                <div id="step2-mahasiswa" class="hidden space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2.5 ml-1">Nama Lengkap</label>
                        <input type="text" name="nama_mahasiswa" class="w-full px-5 py-4 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none focus:border-brand focus:bg-white transition-all text-sm" placeholder="Nama lengkap sesuai KTM">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2.5 ml-1">Instansi / Universitas</label>
                        <input type="text" name="instansi_mahasiswa" class="w-full px-5 py-4 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none focus:border-brand focus:bg-white transition-all text-sm" placeholder="Asal kampus Anda">
                    </div>
                    
                    <div class="flex gap-4">
                        <button type="button" onclick="prevStep()" class="w-1/3 bg-slate-100 text-slate-500 font-extrabold py-4 rounded-2xl hover:bg-slate-200 transition-all mt-6 flex items-center justify-center gap-2">
                            Kembali
                        </button>
                        <button type="submit" class="w-2/3 bg-primary text-white font-extrabold py-4 rounded-2xl shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all mt-6">
                            Daftar Akun
                        </button>
                    </div>
                </div>

                {{-- STEP 2: DATA DIRI DOSEN --}}
                <div id="step2-dosen" class="hidden space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2.5 ml-1">Nama Lengkap (beserta Gelar)</label>
                        <input type="text" name="nama_dosen" class="w-full px-5 py-4 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none focus:border-brand focus:bg-white transition-all text-sm" placeholder="Nama dan gelar akademik">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2.5 ml-1">Instansi / Universitas</label>
                        <input type="text" name="instansi_dosen" class="w-full px-5 py-4 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none focus:border-brand focus:bg-white transition-all text-sm" placeholder="Tempat Anda mengajar">
                    </div>
                    
                    <div class="flex gap-4">
                        <button type="button" onclick="prevStep()" class="w-1/3 bg-slate-100 text-slate-500 font-extrabold py-4 rounded-2xl hover:bg-slate-200 transition-all mt-6 flex items-center justify-center gap-2">
                            Kembali
                        </button>
                        <button type="submit" class="w-2/3 bg-brand text-white font-extrabold py-4 rounded-2xl shadow-lg shadow-brand/20 hover:scale-[1.02] active:scale-95 transition-all mt-6">
                            Daftar Akun
                        </button>
                    </div>
                </div>

                <p class="text-center text-slate-500 text-[13px] mt-8">
                    Sudah punya akun? <a href="/login" class="text-brand font-bold hover:underline ml-1">Masuk di sini</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        function selectRole(role) {
            document.getElementById('user_role').value = role;
            
            const tabMahasiswa = document.getElementById('tab-mahasiswa');
            const tabDosen = document.getElementById('tab-dosen');

            if (role === 'mahasiswa') {
                tabMahasiswa.classList.add('bg-white', 'text-brand', 'shadow-sm');
                tabMahasiswa.classList.remove('text-slate-500');
                
                tabDosen.classList.remove('bg-white', 'text-brand', 'shadow-sm');
                tabDosen.classList.add('text-slate-500');
            } else {
                tabDosen.classList.add('bg-white', 'text-brand', 'shadow-sm');
                tabDosen.classList.remove('text-slate-500');
                
                tabMahasiswa.classList.remove('bg-white', 'text-brand', 'shadow-sm');
                tabMahasiswa.classList.add('text-slate-500');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            selectRole(document.getElementById('user_role').value);
        });

        function nextStep() {
            const role = document.getElementById('user_role').value;
            
            document.getElementById('step1').classList.add('hidden');
            document.getElementById('role-selector').classList.add('hidden');
            
            if (role === 'mahasiswa') {
                document.getElementById('step2-mahasiswa').classList.remove('hidden');
            } else {
                document.getElementById('step2-dosen').classList.remove('hidden');
            }

            document.getElementById('badge-step1').classList.replace('bg-brand', 'bg-slate-100');
            document.getElementById('badge-step1').classList.replace('text-white', 'text-slate-400');
            document.getElementById('badge-step2').classList.replace('bg-slate-100', 'bg-brand');
            document.getElementById('badge-step2').classList.replace('text-slate-400', 'text-white');
        }

        function prevStep() {
            document.getElementById('step2-mahasiswa').classList.add('hidden');
            document.getElementById('step2-dosen').classList.add('hidden');
            
            document.getElementById('step1').classList.remove('hidden');
            document.getElementById('role-selector').classList.remove('hidden');

            document.getElementById('badge-step2').classList.replace('bg-brand', 'bg-slate-100');
            document.getElementById('badge-step2').classList.replace('text-white', 'text-slate-400');
            document.getElementById('badge-step1').classList.replace('bg-slate-100', 'bg-brand');
            document.getElementById('badge-step1').classList.replace('text-slate-400', 'text-white');
        }
    </script>
</body>
</html>