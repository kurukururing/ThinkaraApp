@extends('layout.app')
@section('page_title', 'Pengaturan Profil')

@section('content')
<div class="max-w-5xl mx-auto space-y-6 pb-10">

    {{-- Header Profil --}}
    <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm">
        {{-- Cover Banner Ungu --}}
        <div class="h-32 bg-[#7c3aed] w-full"></div>

        <div class="px-8 pb-6 relative flex flex-col md:flex-row md:justify-between md:items-end gap-6">
            <div class="flex items-end gap-5 -mt-12">
                {{-- Foto Profil --}}
                <div class="w-24 h-24 rounded-full border-4 border-white overflow-hidden bg-slate-100 shadow-sm shrink-0">
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $akun->username }}" alt="Profil" class="w-full h-full object-cover">
                </div>
                <div class="pb-1">
                    <h2 class="text-2xl font-black text-slate-800 tracking-tight leading-none mb-1">{{ $akun->mahasiswa->nama_mahasiswa ?? $akun->username }}</h2>
                    <p class="text-[#7c3aed] font-bold text-sm mb-1">@<span>{{ $akun->username }}</span></p>
                    <p class="text-[11px] text-slate-500 font-semibold">{{ ucfirst($akun->user_role) }} | Bergabung {{ $akun->created_at->format('d M Y') }}</p>
                </div>
            </div>

            <button onclick="shareProfile()" class="bg-[#f5f3ff] text-[#7c3aed] font-bold px-6 py-2.5 rounded-xl text-sm hover:bg-[#7c3aed] hover:text-white transition-all shadow-sm">
                Bagikan Profil
            </button>
        </div>
    </div>

    {{-- Grid Konten Bawah (2 Kolom di Desktop) --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- KOLOM KIRI: Form Edit Profil (Mengambil 2 bagian grid) --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Informasi Pribadi --}}
            <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                <h3 class="text-lg font-black text-slate-800 mb-6 tracking-tight">Informasi Pribadi</h3>
                <form action="{{ route('profil.update') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Nama Lengkap</label>
                            <input type="text" name="nama_mahasiswa" value="{{ old('nama_mahasiswa', $akun->mahasiswa->nama_mahasiswa ?? '') }}" class="w-full border border-slate-200 rounded-xl px-5 py-3 text-sm font-semibold text-slate-700 focus:border-[#7c3aed] focus:ring-2 focus:ring-[#7c3aed]/20 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Username</label>
                            <input type="text" name="username" value="{{ old('username', $akun->username) }}" class="w-full border border-slate-200 rounded-xl px-5 py-3 text-sm font-semibold text-slate-700 focus:border-[#7c3aed] focus:ring-2 focus:ring-[#7c3aed]/20 outline-none transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $akun->email) }}" class="w-full border border-slate-200 rounded-xl px-5 py-3 text-sm font-semibold text-slate-700 focus:border-[#7c3aed] focus:ring-2 focus:ring-[#7c3aed]/20 outline-none transition-all">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Jenjang</label>
                            <input type="text" name="jenjang" value="{{ old('jenjang', $akun->mahasiswa->jenjang ?? '') }}" placeholder="-" class="w-full border border-slate-200 rounded-xl px-5 py-3 text-sm font-semibold text-slate-700 focus:border-[#7c3aed] outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', optional($akun->mahasiswa?->tanggal_lahir)->format('Y-m-d')) }}" placeholder="-" class="w-full border border-slate-200 rounded-xl px-5 py-3 text-sm font-semibold text-slate-700 focus:border-[#7c3aed] outline-none transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">
                                Jenis Kelamin
                            </label>

                            <select
                                name="jenis_kelamin"
                                class="w-full border border-slate-200 rounded-xl px-5 py-3 text-sm font-semibold text-slate-700 bg-white focus:border-[#7c3aed] focus:ring-2 focus:ring-[#7c3aed]/20 outline-none transition-all">

                                <option value="">Pilih Jenis Kelamin</option>

                                <option value="Laki-laki"
                                {{ old('jenis_kelamin', $akun->mahasiswa->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>

                                <option value="Perempuan"
                                {{ old('jenis_kelamin', $akun->mahasiswa->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>

                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Institusi</label>
                            <input type="text" name="instansi" value="{{ old('instansi', $akun->mahasiswa->instansi ?? '') }}" placeholder="-" class="w-full border border-slate-200 rounded-xl px-5 py-3 text-sm font-semibold text-slate-700 focus:border-[#7c3aed] outline-none transition-all">
                        </div>
                    </div>

                    <div class="text-right pt-2">
                        <button type="submit" class="bg-[#7c3aed] text-white font-bold px-8 py-3 rounded-xl text-sm shadow-sm hover:bg-[#6d28d9] transition-all">Simpan</button>
                    </div>
                </form>
            </div>

            {{-- Keamanan Akun --}}
            <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                <h3 class="text-lg font-black text-slate-800 mb-6 tracking-tight">Keamanan Akun</h3>
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('profil.password.update') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Password Saat Ini</label>
                        <input type="password" name="current_password" required class="w-full border border-slate-200 rounded-xl px-5 py-3 text-sm font-semibold text-slate-700 focus:border-[#7c3aed] focus:ring-2 focus:ring-[#7c3aed]/20 outline-none transition-all">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Password Baru</label>
                            <input type="password" name="password" placeholder="Masukan Password Baru" required class="w-full border border-slate-200 rounded-xl px-5 py-3 text-sm font-semibold text-slate-700 focus:border-[#7c3aed] focus:ring-2 focus:ring-[#7c3aed]/20 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" placeholder="Ulangi Password Baru" required class="w-full border border-slate-200 rounded-xl px-5 py-3 text-sm font-semibold text-slate-700 focus:border-[#7c3aed] focus:ring-2 focus:ring-[#7c3aed]/20 outline-none transition-all">
                        </div>
                    </div>
                    <div class="text-right pt-2">
                        <button type="submit" class="bg-[#7c3aed] text-white font-bold px-8 py-3 rounded-xl text-sm shadow-sm hover:bg-[#6d28d9] transition-all">Perbarui Password</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- KOLOM KANAN: Widget (Mengambil 1 bagian grid) --}}
        <div class="space-y-6">

            {{-- Lencana Saya --}}
            <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                <h3 class="text-lg font-black text-slate-800 mb-5 tracking-tight">Lencana Saya</h3>
                <div class="flex flex-wrap gap-4">
                    <div class="w-20 h-20 bg-[#fff1f2] rounded-2xl flex flex-col items-center justify-center border border-[#ffe4e6] shadow-sm">
                        <span class="text-2xl mb-1">🔥</span>
                        <span class="text-[9px] font-black uppercase tracking-wider text-[#be123c]">{{ $badgeAkurat }}</span>
                    </div>
                    <div class="w-20 h-20 bg-[#eff6ff] rounded-2xl flex flex-col items-center justify-center border border-[#dbeafe] shadow-sm">
                        <span class="text-2xl mb-1">⏩</span>
                        <span class="text-[9px] font-black uppercase tracking-wider text-[#1d4ed8]">{{ $badgeCepat }}</span>
                    </div>
                    <div class="w-20 h-20 bg-[#f5f3ff] rounded-2xl flex flex-col items-center justify-center border border-[#ede9fe] shadow-sm">
                        <span class="text-2xl mb-1">📊</span>
                        <span class="text-[9px] font-black uppercase tracking-wider text-[#6d28d9]">{{ $badge }}</span>
                    </div>
                </div>
            </div>

            {{-- Status Akun --}}
            <div class="bg-[#7c3aed] p-8 rounded-3xl text-white shadow-md relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="font-black text-white/70 text-[10px] uppercase tracking-widest mb-2">Status Akun</h3>
                    <p class="text-2xl font-black mb-3 tracking-tight">Pemikir Pro</p>
                    <p class="text-sm text-white/90 mb-6 font-medium leading-relaxed">Kamu memiliki akses penuh ke semua modul latihan dan analisis tingkat lanjut.</p>
                    <button onclick="openSubscriptionModal()" class="w-full bg-white text-[#7c3aed] font-black py-3.5 rounded-xl text-sm shadow-sm hover:bg-slate-50 transition-all">Kelola Langganan</button>
                </div>
            </div>

            {{-- Zona Berbahaya --}}
            <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                <h3 class="text-lg font-black text-slate-800 mb-5 tracking-tight">Zona Berbahaya</h3>
                <form id="form-logout" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="button" id="btn-logout" class="w-full bg-[#fff1f2] text-[#e11d48] font-black py-3.5 rounded-xl text-sm flex justify-between items-center px-5 mb-3 border border-[#ffe4e6] hover:bg-[#ffe4e6] transition-all">
                        Keluar dari Akun
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
                <form id="form-delete-akun" action="{{ route('profil.delete') }}" method="POST">
                    @csrf
                    <button type="button" id="btn-delete-akun" class="w-full text-slate-400 font-bold py-2 text-[11px] uppercase tracking-wider text-left px-2 hover:text-[#e11d48] transition-all">
                        Hapus Akun Permanen
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<div id="subscriptionModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">

    <div class="bg-white rounded-3xl p-8 w-[450px]">

        <h3 class="text-xl font-black mb-6">
            Pilih Paket
        </h3>

        <div class="space-y-4">

            <div class="border rounded-xl p-4">
                <h4 class="font-bold">
                    Pemikir Pemula
                </h4>

                <p class="text-sm text-slate-500">
                    Gratis
                </p>
            </div>

            <div class="border rounded-xl p-4 border-brand">
                <h4 class="font-bold">
                    Pemikir Pro
                </h4>

                <p class="text-sm text-slate-500">
                    Rp 29.000 / bulan
                </p>
            </div>

        </div>

        <button
        onclick="closeSubscriptionModal()"
        class="mt-6 w-full bg-brand text-white py-3 rounded-xl">

            Tutup

        </button>

    </div>

</div>

{{-- Tambahkan CDN SweetAlert2 untuk tampilan modal --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function shareProfile()
    {
        navigator.clipboard.writeText(window.location.href);

        alert('Link profil berhasil disalin.');
    }

    function openSubscriptionModal()
    {
        document.getElementById('subscriptionModal')
            .classList.remove('hidden');
    }

    function closeSubscriptionModal()
    {
        document.getElementById('subscriptionModal')
            .classList.add('hidden');
    }
</script>
@endsection
