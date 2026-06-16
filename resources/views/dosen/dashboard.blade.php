    @extends('dosen.layout')
    @section('page_title', 'Manajemen Quiz')

    @section('content')
    <div class="max-w-5xl mx-auto space-y-8">

        <!-- header -->
        <div class="bg-brand rounded-[2rem] p-10 text-white shadow-lg relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-52 h-52 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-accent/20 rounded-full blur-2xl pointer-events-none"></div>

            <span class="bg-white/20 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-4 inline-block">
                Panel Dosen
            </span>
            <h2 class="text-3xl font-extrabold mb-2">
                Halo, {{ Auth::user()->username }}! 👋
            </h2>
            <p class="text-white/80 text-sm max-w-lg">
                Buat dan kelola quiz untuk mahasiswamu disini!
            </p>

            <div class="mt-6 flex items-center gap-3">
                <div class="bg-white/15 rounded-2xl px-5 py-3 flex items-center gap-3">
                    <span class="text-2xl font-black">{{ $totalQuiz }}/{{ $maxQuiz }}</span>
                    <span class="text-white/70 text-xs leading-tight">Quiz dibuat</span>
                </div>
                <div class="flex-1 max-w-xs">
                    <div class="flex justify-between text-[10px] text-white/60 mb-1">
                        <span>Kuota terpakai</span>
                        <span>{{ $totalQuiz }}/{{ $maxQuiz }}</span>
                    </div>
                    <div class="h-2 bg-white/20 rounded-full overflow-hidden">
                        <div
                            class="h-full rounded-full transition-all duration-500 {{ $totalQuiz >= $maxQuiz ? 'bg-red-400' : 'bg-white' }}"
                            style="width: {{ min(100, ($totalQuiz / $maxQuiz) * 100) }}%"
                        ></div>
                    </div>
                </div>
            </div>
        </div>
            
        <!-- pesan suskses atau error setelah submit form -->
        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 rounded-2xl px-6 py-4 text-sm font-medium flex items-center gap-3">
            <span class="text-lg">✅</span> {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-2xl px-6 py-4 text-sm font-medium flex items-center gap-3">
            <span class="text-lg">⚠️</span> {{ session('error') }}
        </div>
        @endif

        <!-- buat quiz baru -->
        <div>
            <h3 class="text-base font-extrabold text-slate-800 mb-4">Buat Quiz Baru</h3>

            @if($totalQuiz >= $maxQuiz)
            <div class="bg-amber-50 border border-amber-200 rounded-2xl px-6 py-5 text-sm text-amber-700">
                <p class="font-bold mb-1">🚫 Batas kuota tercapai</p>
                <p>Kamu sudah membuat {{ $maxQuiz }} quiz. Hapus quiz yang tidak digunakan untuk membuat yang baru.</p>
            </div>
            @else
            <div class="bg-white rounded-2xl border border-slate-100 p-6">
                <form action="{{ route('dosen.store') }}" method="POST" id="formBuatQuiz">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">

                        {{-- Nama Quiz --}}
                        <div class="md:col-span-1">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">
                                Nama Quiz
                            </label>
                            <input
                                type="text"
                                name="nama_quiz"
                                id="inputNamaQuiz"
                                required
                                placeholder="cth. Quiz Logika Minggu 1"
                                value="{{ old('nama_quiz') }}"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-brand/30 focus:border-brand transition"
                            >
                            @error('nama_quiz')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Pilih Jenis Latihan (Custom Dropdown, dikendalikan JS) --}}
                        <div class="md:col-span-1">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">
                                Jenis Latihan
                            </label>
                            {{-- Input yang dikirim ke server --}}
                            <input type="hidden" name="id_latihan" id="hiddenIdLatihan">

                            {{-- dropdown button --}}
                            <div class="relative" id="dropdownJenisLatihan">
                                <button
                                    type="button"
                                    id="btnDropdownTrigger"
                                    class="w-full flex items-center justify-between rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-left text-slate-400 transition focus:outline-none focus:ring-2 focus:ring-brand/30 focus:border-brand"
                                >
                                    <span id="dropdownLabel">Pilih jenis latihan...</span>
                                    <svg id="dropdownChevron" class="w-4 h-4 text-slate-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>

                                {{-- Dropdown isi --}}
                                <div
                                    id="dropdownPanel"
                                    class="hidden absolute z-20 mt-2 w-full bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden opacity-0 -translate-y-2 transition-all duration-200"
                                >
                                    @foreach($jenisList as $latihan)
                                    @php
                                        $icons = [
                                            'Argument Builder' => ['icon' => '🔧', 'desc' => 'Susun blok premis & kesimpulan menjadi argumen valid',      'color' => 'bg-violet-50 text-violet-600'],
                                            'Fallacy Finder'   => ['icon' => '✨', 'desc' => 'Deteksi kecacatan logika dari studi kasus (pilihan ganda)',   'color' => 'bg-fuchsia-50 text-fuchsia-600'],
                                            'Fix the Argument' => ['icon' => '🛠️','desc' => 'Perbaiki argumen agar sesuai struktur yang benar',            'color' => 'bg-blue-50 text-blue-600'],
                                            'Gamified QTE'     => ['icon' => '⚡', 'desc' => 'Lengkapi paragraf dalam batas waktu tertentu',                'color' => 'bg-orange-50 text-orange-600'],
                                        ];
                                        $meta = $icons[$latihan->nama_latihan] ?? ['icon' => '📝', 'desc' => '', 'color' => 'bg-slate-50 text-slate-600'];
                                    @endphp
                                    <button
                                        type="button"
                                        class="dropdown-option w-full flex items-center gap-3 px-4 py-3 hover:bg-slate-50 transition text-left border-b border-slate-50 last:border-0"
                                        data-id="{{ $latihan->id_latihan }}"
                                        data-label="{{ $latihan->nama_latihan }}"
                                    >
                                        <div class="w-9 h-9 {{ $meta['color'] }} rounded-lg flex items-center justify-center text-base shrink-0">
                                            {{ $meta['icon'] }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-bold text-slate-700">{{ $latihan->nama_latihan }}</p>
                                            <p class="text-[11px] text-slate-400">{{ $meta['desc'] }}</p>
                                        </div>
                                        {{-- Centang terpilih --}}
                                        <svg class="check-icon w-4 h-4 text-brand hidden shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Submit --}}
                        <div>
                            <button
                                type="submit"
                                id="btnBuatQuiz"
                                class="w-full bg-brand text-white font-bold py-2.5 px-6 rounded-xl hover:bg-brand-dark transition flex items-center justify-center gap-2 text-sm"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Buat Quiz
                            </button>
                        </div>
                    </div>

                    <!-- <p class="text-[11px] text-slate-400 mt-3">
                        💡 Sistem akan otomatis memilih <strong>5 soal acak</strong> dari bank soal jenis latihan yang dipilih, lalu menghasilkan link unik untuk dibagikan.
                    </p> -->
                </form>
            </div>
            @endif
        </div>

        <!-- daftar quiz  -->
        <div>
            <div class="flex justify-between items-end mb-4">
                <div>
                    <h3 class="text-base font-extrabold text-slate-800">Quiz Kamu</h3>
                    <p class="text-xs text-slate-500">Kelola, bagikan, atau hapus quiz yang sudah dibuat.</p>
                </div>
                <span class="text-xs text-slate-400 bg-slate-100 px-3 py-1 rounded-full font-semibold">
                    {{ $totalQuiz }}/{{ $maxQuiz }} quiz
                </span>
            </div>

            @if($quizList->isEmpty())
            <div class="bg-white rounded-2xl border border-slate-100 border-dashed py-16 flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-brand/10 rounded-2xl flex items-center justify-center text-3xl mb-4">📋</div>
                <p class="font-bold text-slate-700 mb-1">Belum ada quiz</p>
                <p class="text-xs text-slate-400 max-w-xs">Buat quiz pertamamu di atas. Quiz akan otomatis berisi 5 soal acak dan memiliki link unik siap dibagikan.</p>
            </div>
            @else
            <div class="space-y-3">
                @foreach($quizList as $quiz)
                <div class="bg-white rounded-2xl border border-slate-100 p-5 flex flex-col md:flex-row md:items-center gap-4">

                    {{-- Info quiz --}}
                    <div class="flex items-center gap-4 flex-1 min-w-0">
                        @php
                            $quizIcons = [
                                'Argument Builder' => ['icon' => '🔧', 'color' => 'bg-violet-100 text-violet-600'],
                                'Fallacy Finder'   => ['icon' => '✨', 'color' => 'bg-fuchsia-100 text-fuchsia-600'],
                                'Fix the Argument' => ['icon' => '🛠️', 'color' => 'bg-blue-100 text-blue-600'],
                                'Gamified QTE'     => ['icon' => '⚡', 'color' => 'bg-orange-100 text-orange-600'],
                            ];
                            $qi = $quizIcons[$quiz->latihan->nama_latihan ?? ''] ?? ['icon' => '📝', 'color' => 'bg-slate-100 text-slate-600'];
                        @endphp
                        <div class="w-11 h-11 {{ $qi['color'] }} rounded-xl flex items-center justify-center text-xl shrink-0">
                            {{ $qi['icon'] }}
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <p class="font-bold text-slate-800 truncate">{{ $quiz->nama_quiz }}</p>
                                @if($quiz->is_active)
                                    <span class="bg-green-100 text-green-600 text-[10px] font-bold px-2 py-0.5 rounded-full">Aktif</span>
                                @else
                                    <span class="bg-slate-100 text-slate-400 text-[10px] font-bold px-2 py-0.5 rounded-full">Nonaktif</span>
                                @endif
                            </div>
                            <p class="text-[11px] text-slate-400 mt-0.5">
                                {{ $quiz->latihan->nama_latihan ?? '-' }} &bull; Dibuat {{ $quiz->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>

                    <!-- info link quiz -->
                    <div class="flex-1 min-w-0 md:max-w-xs">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Link Quiz</p>
                        <div class="flex items-center gap-2">
                            <div class="flex-1 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-500 truncate font-mono">
                                {{ url('/quiz/' . $quiz->slug) }}
                            </div>
                            <!-- tombol copy link -->
                            <button
                                type="button"
                                class="btn-copy-link shrink-0 w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-brand hover:text-white hover:border-brand transition"
                                data-url="{{ url('/quiz/' . $quiz->slug) }}"
                                title="Salin link"
                            >
                                <svg class="icon-copy w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                                <svg class="icon-check w-4 h-4 hidden text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </button>
                        </div>
                        <p class="copy-feedback text-[10px] text-green-500 mt-1 font-semibold hidden">✓ Link tersalin!</p>
                    </div>

                    <!-- Aksi (aktif/nonaktif, hapus) -->   
                    <div class="flex items-center gap-2 shrink-0">
                        {{-- Toggle Aktif/Nonaktif --}}
                        <form action="{{ route('dosen.toggle', $quiz->id_quiz) }}" method="POST">
                            @csrf @method('PATCH')
                            <button
                                type="submit"
                                title="{{ $quiz->is_active ? 'Nonaktifkan' : 'Aktifkan' }}"
                                class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center transition
                                    {{ $quiz->is_active ? 'text-green-500 hover:bg-green-50' : 'text-slate-400 hover:bg-slate-50' }}"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="{{ $quiz->is_active
                                            ? 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'
                                            : 'M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21'
                                        }}"
                                    />
                                </svg>
                            </button>
                        </form>

                        <!-- tombol hapus -->
                        <div class="relative">
                            <button
                                type="button"
                                class="btn-hapus-quiz w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-red-400 hover:bg-red-50 hover:border-red-200 transition"
                                title="Hapus quiz"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>

                            <!-- konfirmasi hapus -->
                            <div class="confirm-hapus hidden absolute right-0 bottom-12 z-30 bg-white rounded-2xl shadow-xl border border-red-100 p-4 w-56">
                                <p class="text-sm font-bold text-slate-700 mb-1">Hapus quiz ini?</p>
                                <p class="text-xs text-slate-400 mb-3">Tindakan ini tidak bisa dibatalkan.</p>
                                <div class="flex gap-2">
                                    <button type="button" class="btn-batal-hapus flex-1 text-xs font-bold py-2 rounded-xl bg-slate-100 text-slate-500 hover:bg-slate-200 transition">
                                        Batal
                                    </button>
                                    <form action="{{ route('dosen.destroy', $quiz->id_quiz) }}" method="POST" class="flex-1">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-full text-xs font-bold py-2 rounded-xl bg-red-500 text-white hover:bg-red-600 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- informasi jenis latihan -->
        <div>
            <h3 class="text-base font-extrabold text-slate-800 mb-4">Tentang Jenis Latihan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @php
                    $jenisInfo = [
                        ['icon' => '🔧', 'nama' => 'Argument Builder',  'color' => 'bg-violet-50 border-violet-100',  'tag_color' => 'bg-violet-100 text-violet-600',   'desc' => 'Mahasiswa menyusun blok-blok premis dan kesimpulan yang acak menjadi satu kesatuan argumen yang valid berdasarkan struktur claim, evidence, reasoning, dan reference.'],
                        ['icon' => '✨', 'nama' => 'Fallacy Finder',    'color' => 'bg-fuchsia-50 border-fuchsia-100','tag_color' => 'bg-fuchsia-100 text-fuchsia-600', 'desc' => 'Mahasiswa mendeteksi letak kecacatan logika (Logical Fallacy) yang tersembunyi pada sebuah studi kasus melalui pilihan ganda (a, b, c, d).'],
                        ['icon' => '🛠️', 'nama' => 'Fix the Argument',  'color' => 'bg-blue-50 border-blue-100',      'tag_color' => 'bg-blue-100 text-blue-600',      'desc' => 'Mahasiswa memperbaiki argumen yang salah agar sesuai dengan struktur yang benar: claim, evidence, reasoning, dan reference.'],
                        ['icon' => '⚡', 'nama' => 'Gamified QTE',      'color' => 'bg-orange-50 border-orange-100',  'tag_color' => 'bg-orange-100 text-orange-600',  'desc' => 'Mahasiswa melengkapi paragraf yang tidak lengkap dengan jawaban yang tepat, dalam batas waktu yang ditentukan. Uji kecepatan dan ketepatan berpikir!'],
                    ];
                @endphp
                @foreach($jenisInfo as $info)
                <div class="rounded-2xl border p-5 {{ $info['color'] }} flex gap-4">
                    <div class="text-2xl shrink-0 mt-0.5">{{ $info['icon'] }}</div>
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <p class="font-bold text-slate-800 text-sm">{{ $info['nama'] }}</p>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $info['tag_color'] }}">5 soal/quiz</span>
                        </div>
                        <p class="text-xs text-slate-500 leading-relaxed">{{ $info['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
    @endsection