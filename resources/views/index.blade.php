<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>THINKARA | Asah Kritis, Mandiri Tanpa AI</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="text-slate-700 font-nunito bg-surface">

        {{-- Navigasi --}}
        <nav class="fixed top-0 left-0 w-full glass-nav z-50 h-[5.5rem] flex items-center transition-all">
            <div class="max-w-7xl w-full mx-auto px-6 flex justify-between items-center">
                <span class="text-2xl font-extrabold text-brand tracking-tight flex items-center gap-2">
                    <div class="w-8 h-8 bg-brand rounded-xl flex items-center justify-center text-white text-lg">✨</div>
                    THINKARA
                </span>
                
                <div class="hidden md:flex items-center space-x-8 font-semibold text-slate-600">
                    <a href="#home" class="hover:text-brand transition-colors">Beranda</a>
                    <a href="#about" class="hover:text-brand transition-colors">Tentang</a>
                    <a href="#features" class="hover:text-brand transition-colors">Fitur</a>
                    <a href="#team" class="hover:text-brand transition-colors">Tim</a>
                    <a href="#faq" class="hover:text-brand transition-colors">FAQ</a>
                </div>

                <div class="hidden md:flex items-center space-x-4">
                    <a href="/register" class="text-slate-500 hover:text-brand font-semibold transition-colors">Daftar</a>
                    <a href="/login" class="bg-primary text-white px-6 py-2.5 rounded-full hover:bg-brand transition-all font-bold shadow-lg shadow-brand-light">Masuk</a>
                </div>

                <button id="mobileMenuBtn" class="md:hidden text-brand focus:outline-none">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </nav>

        {{-- Hero --}}
        <section id="home" class="relative overflow-hidden bg-gradient-to-b from-brand-light/30 via-white to-surface min-h-screen flex items-center pt-24 pb-12">
            <div class="absolute top-20 left-10 w-64 h-64 bg-accent-light rounded-full mix-blend-multiply filter blur-3xl opacity-40"></div>
            <div class="absolute top-40 right-20 w-72 h-72 bg-brand-light rounded-full mix-blend-multiply filter blur-3xl opacity-40"></div>
            
            <div class="max-w-5xl mx-auto px-6 relative z-10 text-center w-full">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-brand-light soft-shadow text-brand font-bold text-sm mb-8">
                    <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-brand"></span>
                    </span>
                    Asah Kritis, Mandiri Tanpa AI
                </div>
                
                <h1 class="text-5xl md:text-7xl font-extrabold text-slate-800 mb-6 leading-[1.1] tracking-tight">
                    Berhenti Menyalin,<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand to-accent">Mulai Memahami. 🧠</span>
                </h1>
                
                <p class="text-lg md:text-xl font-medium text-slate-500 mb-10 max-w-2xl mx-auto">
                    Kembangkan kemampuan berpikir kritis. Otakmu lebih hebat dari algoritma manapun. Mari berlatih secara menyenangkan!
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="#features" class="bg-secondary text-white font-bold py-4 px-8 rounded-full shadow-lg hover:-translate-y-1 transition transform w-full sm:w-auto text-center text-lg">Mulai Bermain 🚀</a>
                    <a href="#about" class="bg-white text-slate-700 border border-slate-200 py-4 px-8 rounded-full font-bold hover:bg-slate-50 transition w-full sm:w-auto text-center text-lg">Pelajari Lebih Lanjut</a>
                </div>
            </div>
        </section>

        {{-- About --}}
        <section id="about" class="py-24 bg-white relative z-20 overflow-hidden border-y border-slate-100">
            <div class="max-w-7xl mx-auto px-6 w-full flex flex-col lg:flex-row items-center gap-16">
                <div class="w-full lg:w-1/2 relative">
                    <div class="absolute -inset-4 bg-accent-light/50 rounded-[3rem] transform -rotate-3 z-0"></div>
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&q=80&w=800" alt="Students studying" class="relative z-10 rounded-[2rem] shadow-xl border-4 border-white object-cover aspect-video md:aspect-[4/3] w-full">
                    <div class="absolute -bottom-6 -right-6 bg-white p-4 rounded-2xl shadow-lg border border-slate-100 z-20 hover:scale-110 transition-transform">
                        <span class="text-4xl">💡</span>
                    </div>
                </div>
                
                <div class="w-full lg:w-1/2 space-y-8 relative z-10">
                    <div>
                        <span class="text-accent font-bold tracking-wider uppercase text-sm mb-2 block">Mengapa Berpikir Kritis?</span>
                        <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 leading-tight mb-6"> Otakmu Lebih Hebat dari <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand to-accent">Algoritma.</span></h2>
                        <p class="text-lg text-slate-500 leading-relaxed font-medium">Di era di mana AI bisa menjawab hampir segalanya, kemampuan untuk menganalisis dan memecahkan masalah secara mandiri menjadi sangat mahal.</p>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 bg-slate-50 hover:bg-white p-4 rounded-2xl border border-slate-100 soft-shadow transition-all">
                            <div class="w-14 h-14 bg-brand-light/30 text-brand rounded-xl flex items-center justify-center font-extrabold text-xl shrink-0">1</div>
                            <p class="font-bold text-slate-700">Meningkatkan Logika Pemecahan Masalah</p>
                        </div>
                        <div class="flex items-center gap-4 bg-slate-50 hover:bg-white p-4 rounded-2xl border border-slate-100 soft-shadow transition-all">
                            <div class="w-14 h-14 bg-accent-light/30 text-accent rounded-xl flex items-center justify-center font-extrabold text-xl shrink-0">2</div>
                            <p class="font-bold text-slate-700">Mencegah Plagiarisme Otomatis</p>
                        </div>
                        <div class="flex items-center gap-4 bg-slate-50 hover:bg-white p-4 rounded-2xl border border-slate-100 soft-shadow transition-all">
                            <div class="w-14 h-14 bg-warning/10 text-warning rounded-xl flex items-center justify-center font-extrabold text-xl shrink-0">3</div>
                            <p class="font-bold text-slate-700">Membangun Karakter Akademik yang Jujur</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Features --}}
        <section id="features" class="py-24 relative z-20">
            <div class="max-w-7xl mx-auto px-6 w-full">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 mb-4">Mode Latihan <span class="text-brand">Thinkara</span> 🎮</h2>
                    <p class="text-lg text-slate-500 max-w-2xl mx-auto font-medium">Asah kemampuan logikamu melalui simulasi interaktif yang menantang.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Argument Builder --}}
                    <div class="bg-white p-8 rounded-[2rem] soft-shadow border border-slate-100 hover:-translate-y-2 transition-all">
                        <div class="w-16 h-16 bg-info/10 rounded-2xl flex items-center justify-center text-3xl mb-6 border border-info/20">🧩</div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-3">Argument Builder</h3>
                        <p class="text-slate-500 leading-relaxed mb-6">Susun blok-blok premis menjadi argumen yang valid.</p>
                        <a href="#" class="inline-flex items-center justify-center w-full bg-slate-50 hover:bg-info/10 text-info font-bold py-3 rounded-xl transition">Mulai Menyusun &rarr;</a>
                    </div>
                    {{-- Fix The Argument --}}
                    <div class="bg-white p-8 rounded-[2rem] soft-shadow border border-slate-100 hover:-translate-y-2 transition-all">
                        <div class="w-16 h-16 bg-accent-light/30 rounded-2xl flex items-center justify-center text-3xl mb-6 border border-accent/20">🛠️</div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-3">Fix The Argument</h3>
                        <p class="text-slate-500 leading-relaxed mb-6">Analisis titik kelemahan teks dan perbaiki struktur argumen.</p>
                        <a href="#" class="inline-flex items-center justify-center w-full bg-slate-50 hover:bg-accent-light/30 text-accent font-bold py-3 rounded-xl transition">Perbaiki Sekarang &rarr;</a>
                    </div>
                    {{-- QTE Typing --}}
                    <div class="bg-white p-8 rounded-[2rem] soft-shadow border border-slate-100 hover:-translate-y-2 transition-all">
                        <div class="w-16 h-16 bg-brand-light/30 rounded-2xl flex items-center justify-center text-3xl mb-6 border border-brand/20">⚡</div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-3">QTE Typing Challenge</h3>
                        <p class="text-slate-500 leading-relaxed mb-6">Tingkatkan refleks dengan mengetik cepat di bawah tekanan.</p>
                        <a href="#" class="inline-flex items-center justify-center w-full bg-slate-50 hover:bg-brand-light/30 text-brand font-bold py-3 rounded-xl transition">Mulai Mengetik &rarr;</a>
                    </div>
                    {{-- Fallacy Finder --}}
                    <div class="bg-white p-8 rounded-[2rem] soft-shadow border border-slate-100 hover:-translate-y-2 transition-all">
                        <div class="w-16 h-16 bg-warning/10 rounded-2xl flex items-center justify-center text-3xl mb-6 border border-warning/20">🕵️</div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-3">Fallacy Finder</h3>
                        <p class="text-slate-500 leading-relaxed mb-6">Deteksi letak kecacatan logika pada sebuah studi kasus.</p>
                        <a href="#" class="inline-flex items-center justify-center w-full bg-slate-50 hover:bg-warning/10 text-warning font-bold py-3 rounded-xl transition">Cari Kesalahan &rarr;</a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Testimonials --}}
        <section id="testimonials" class="py-24 bg-white relative border-t border-slate-100">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <span class="text-brand font-bold tracking-wider uppercase text-sm mb-2 block">Kata Mereka</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 mb-12">Disukai Mahasiswa & Pelajar 💬</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                    {{-- Nisa --}}
                    <div class="bg-surface p-8 rounded-[2rem] soft-shadow border border-slate-50 hover:-translate-y-2 transition-transform relative">
                        <div class="text-4xl absolute top-6 right-8 opacity-20">❝</div>
                        <p class="text-slate-600 mb-8 font-medium italic relative z-10">"Sejak main Thinkara, aku jadi lebih gampang nyusun esai tanpa harus bolak-balik nanya AI."</p>
                        <div class="flex items-center gap-4">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Nisa" class="w-12 h-12 rounded-full border-2 border-brand-light">
                            <div><h4 class="font-bold text-slate-800">Anisa Putri</h4><p class="text-sm text-slate-500">Mahasiswa Ilmu Komunikasi</p></div>
                        </div>
                    </div>
                    {{-- Riko --}}
                    <div class="bg-surface p-8 rounded-[2rem] soft-shadow border border-slate-50 hover:-translate-y-2 transition-transform relative">
                        <div class="text-4xl absolute top-6 right-8 opacity-20">❝</div>
                        <p class="text-slate-600 mb-8 font-medium italic relative z-10">"Latihan di sini bikin mikir lebih struktural. UI-nya juga fresh banget, ga ngebosenin!"</p>
                        <div class="flex items-center gap-4">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Riko" class="w-12 h-12 rounded-full border-2 border-accent-light">
                            <div><h4 class="font-bold text-slate-800">Riko Pratama</h4><p class="text-sm text-slate-500">Siswa SMA Plus</p></div>
                        </div>
                    </div>
                    {{-- Tari --}}
                    <div class="bg-surface p-8 rounded-[2rem] soft-shadow border border-slate-50 hover:-translate-y-2 transition-transform relative">
                        <div class="text-4xl absolute top-6 right-8 opacity-20">❝</div>
                        <p class="text-slate-600 mb-8 font-medium italic relative z-10">"Platform yang ngebantu banget buat stop kebiasaan copas tugas dari ChatGPT."</p>
                        <div class="flex items-center gap-4">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Tari" class="w-12 h-12 rounded-full border-2 border-warning/30">
                            <div><h4 class="font-bold text-slate-800">Lestari</h4><p class="text-sm text-slate-500">Mahasiswa Hukum</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- SECTION FAQ --}}
        <section id="faq" class="py-24 bg-surface relative">
            <div class="max-w-3xl mx-auto px-6">
                <div class="text-center mb-12">
                    <span class="text-accent font-bold tracking-wider uppercase text-sm mb-2 block">Punya Pertanyaan?</span>
                    <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800">FAQ 🤔</h2>
                </div>

                <div class="space-y-4">
                    {{-- FAQ 1 --}}
                    <details class="group bg-white rounded-2xl shadow-sm border border-slate-100 hover:border-brand-light transition-colors cursor-pointer" open>
                        <summary class="flex justify-between items-center font-bold text-lg text-slate-800 p-6 outline-none">
                            Apakah Thinkara gratis digunakan?
                            <span class="transition duration-300 group-open:-rotate-180 text-brand">
                                <svg fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg>
                            </span>
                        </summary>
                        <p class="text-slate-500 font-medium px-6 pb-6 mt-[-10px]">
                            Ya! Semua fitur dasar untuk melatih logika dan berpikir kritis bisa kamu akses secara gratis.
                        </p>
                    </details>

                    {{-- FAQ 2 --}}
                    <details class="group bg-white rounded-2xl shadow-sm border border-slate-100 hover:border-brand-light transition-colors cursor-pointer">
                        <summary class="flex justify-between items-center font-bold text-lg text-slate-800 p-6 outline-none">
                            Apakah ini menggantikan ChatGPT atau AI lainnya?
                            <span class="transition duration-300 group-open:-rotate-180 text-brand">
                                <svg fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg>
                            </span>
                        </summary>
                        <p class="text-slate-500 font-medium px-6 pb-6 mt-[-10px]">
                            Tidak, Thinkara bukan AI penjawab soal. Ini adalah platform gamifikasi agar kamu bisa berpikir mandiri dan tidak selalu bergantung pada AI saat mengerjakan tugas.
                        </p>
                    </details>

                    {{-- FAQ 3 --}}
                    <details class="group bg-white rounded-2xl shadow-sm border border-slate-100 hover:border-brand-light transition-colors cursor-pointer">
                        <summary class="flex justify-between items-center font-bold text-lg text-slate-800 p-6 outline-none">
                            Apakah ada aplikasi mobile-nya?
                            <span class="transition duration-300 group-open:-rotate-180 text-brand">
                                <svg fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg>
                            </span>
                        </summary>
                        <p class="text-slate-500 font-medium px-6 pb-6 mt-[-10px]">
                            Saat ini Thinkara berbasis web yang sangat responsif, sehingga tetap nyaman diakses lewat browser di HP kamu. Versi aplikasi sedang dalam pengembangan.
                        </p>
                    </details>

                    {{-- FAQ 4 --}}
                    <details class="group bg-white rounded-2xl shadow-sm border border-slate-100 hover:border-brand-light transition-colors cursor-pointer">
                        <summary class="flex justify-between items-center font-bold text-lg text-slate-800 p-6 outline-none">
                            Bagaimana cara melaporkan bug atau memberi saran?
                            <span class="transition duration-300 group-open:-rotate-180 text-brand">
                                <svg fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg>
                            </span>
                        </summary>
                        <p class="text-slate-500 font-medium px-6 pb-6 mt-[-10px]">
                            Kamu bisa langsung mengirim email ke support@thinkara.id atau menghubungi kami melalui sosial media resmi kami.
                        </p>
                    </details>
                </div>
            </div>
        </section>

        {{-- FOOTER --}}
        <footer class="bg-slate-900 pt-20 pb-10 relative overflow-hidden mt-10">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-brand/20 rounded-full blur-3xl -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-accent/20 rounded-full blur-3xl translate-y-1/2"></div>

            <div class="max-w-7xl mx-auto px-6 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16 border-b border-slate-800 pb-12">
                    
                    <div class="md:col-span-2">
                        <span class="text-3xl font-extrabold text-white tracking-tight flex items-center gap-2 mb-6">
                            <div class="w-10 h-10 bg-brand rounded-xl flex items-center justify-center text-white text-xl shadow-lg shadow-brand/30">✨</div>
                            THINKARA.
                        </span>

                        <p class="text-slate-400 max-w-sm leading-relaxed mb-8 font-medium">
                            Platform gamifikasi untuk mengasah logika dan mencegah ketergantungan pada AI. Kendalikan teknologi, jangan biarkan ia mengendalikanmu.
                        </p>
                        <a href="mailto:support@thinkara.id" class="inline-block bg-white text-slate-900 font-bold py-3 px-8 rounded-full hover:scale-105 transition transform shadow-lg">
                            Hubungi Kami
                        </a>
                    </div>

                    <div>
                        <h4 class="text-white font-bold mb-6 text-lg">Tautan Cepat</h4>
                        <ul class="space-y-4 text-slate-400 font-medium">
                            <li><a href="#home" class="hover:text-brand-light transition-colors">Beranda</a></li>
                            <li><a href="#about" class="hover:text-brand-light transition-colors">Tentang Platform</a></li>
                            <li><a href="#testimonials" class="hover:text-brand-light transition-colors">Testimoni</a></li>
                            <li><a href="#faq" class="hover:text-brand-light transition-colors">FAQ</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-white font-bold mb-6 text-lg">Ikuti Kami</h4>
                        <div class="flex gap-4 mb-8">
                            <a href="#" class="w-12 h-12 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-brand hover:text-white transition-all shadow-md">IG</a>
                            <a href="#" class="w-12 h-12 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-brand hover:text-white transition-all shadow-md">TW</a>
                            <a href="#" class="w-12 h-12 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-brand hover:text-white transition-all shadow-md">IN</a>
                        </div>
                        <p class="text-sm text-slate-500 font-medium">Dapatkan info update fitur dan tips belajar terbaru dari Thinkara.</p>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row justify-between items-center text-slate-500 text-sm font-semibold">
                    <p>&copy; 2026 Thinkara Project. Hak Cipta Dilindungi.</p>
                    <div class="flex gap-6 mt-4 md:mt-0">
                        <a href="#" class="hover:text-white transition">Syarat & Ketentuan</a>
                        <a href="#" class="hover:text-white transition">Kebijakan Privasi</a>
                    </div>
                </div>
            </div>
        </footer>

    </body>
</html>