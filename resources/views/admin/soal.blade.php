<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Soal - Thinkara Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-[#F8F9FE] text-slate-800 font-sans antialiased flex h-screen overflow-hidden">

    <!-- Sidebar -->
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
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl text-slate-500 hover:bg-slate-50 hover:text-[#7c3aed] font-semibold transition-all hover:scale-[1.02]">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Dashboard
                </a>
                <a href="{{ route('admin.soal') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl bg-[#7c3aed] text-white font-bold shadow-md shadow-[#7c3aed]/20 transition-all hover:-translate-y-0.5">
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
                <h1 class="text-2xl font-black text-slate-800 tracking-tight">Manajemen Soal</h1>
                <p class="text-sm font-semibold text-slate-500">Kelola dan perbarui basis data soal latihan</p>
            </div>
            <button onclick="openModal('addModal')" class="bg-[#7c3aed] text-white px-6 py-2.5 rounded-2xl font-bold flex items-center gap-2 hover:bg-[#6d28d9] hover:shadow-lg hover:shadow-[#7c3aed]/30 transition-all hover:-translate-y-0.5">
                <i data-lucide="plus" class="w-5 h-5"></i> <span>Tambah Soal</span>
            </button>
        </header>

        <!-- Scrollable Table Area -->
        <div class="flex-1 overflow-y-auto p-10">

            <!-- Tampilkan Notifikasi -->
            @if(session('success'))
                <div class="mb-8 p-4 rounded-2xl bg-green-50 border border-green-100 text-green-700 flex items-center gap-3 font-semibold shadow-sm animate-[sweep_0.3s_ease-in-out]">
                    <i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap md:whitespace-normal">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100 text-xs uppercase tracking-wider font-bold text-slate-400">
                                <th class="p-5 px-6 w-20">ID</th>
                                <th class="p-5 px-6 w-44">Kategori</th>
                                <th class="p-5 px-6 w-1/4">Topik</th>
                                <th class="p-5 px-6">Isi Soal</th>
                                <th class="p-5 px-6 w-32 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                            @forelse($soal as $item)
                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="p-5 px-6 font-bold text-slate-400">#{{ $item->id_soal }}</td>
                                    <td class="p-5 px-6">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-[#7c3aed]/10 text-[#7c3aed] border border-[#7c3aed]/20">
                                            <i data-lucide="gamepad-2" class="w-3.5 h-3.5"></i> Latihan {{ $item->id_latihan }}
                                        </span>
                                    </td>
                                    <td class="p-5 px-6 font-semibold text-slate-900 leading-snug">{{ $item->topik }}</td>
                                    <td class="p-5 px-6"><div class="line-clamp-2 text-slate-500 font-medium leading-relaxed">{{ $item->isi_soal }}</div></td>
                                    <td class="p-5 px-6">
                                        <div class="flex items-center justify-center gap-2 opacity-50 group-hover:opacity-100 transition-opacity">
                                            <button onclick="editSoal({{ json_encode($item) }})" class="p-2.5 text-blue-500 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-all shadow-sm border border-transparent hover:border-blue-100" title="Edit Soal">
                                                <i data-lucide="pencil" class="w-4 h-4"></i>
                                            </button>
                                            <button onclick="deleteSoal({{ $item->id_soal }})" class="p-2.5 text-red-500 hover:bg-red-50 hover:text-red-600 rounded-xl transition-all shadow-sm border border-transparent hover:border-red-100" title="Hapus Soal">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-12 text-center text-slate-400 font-medium flex flex-col items-center gap-4">
                                        <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center text-slate-300 mb-2">
                                            <i data-lucide="inbox" class="w-8 h-8"></i>
                                        </div>
                                        Belum ada data soal latihan yang ditambahkan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- ==================== MODALS ==================== -->

    <!-- Modal Tambah Soal -->
    <div id="addModal" class="fixed inset-0 bg-slate-900/60 z-50 hidden items-center justify-center backdrop-blur-md transition-all opacity-0">
        <div class="bg-white w-full max-w-2xl rounded-[2rem] shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300" id="addModalContent">
            <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-white">
                <h3 class="text-xl font-black text-slate-800">Tambah Soal Baru</h3>
                <button onclick="closeModal('addModal')" class="text-slate-400 hover:text-red-500 rounded-xl p-2 hover:bg-red-50 transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <form action="{{ route('admin.soal.store') }}" method="POST" class="p-8 space-y-6">
                @csrf
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kategori / ID Latihan <span class="text-red-500">*</span></label>
                        <select name="id_latihan" id="add_id_latihan" onchange="renderDynamicFields('add')" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-[#7c3aed]/20 focus:border-[#7c3aed] outline-none transition-all font-medium text-slate-700" required>
                            <option value="">Pilih Latihan</option>
                            <option value="1">1 - Argument Builder</option>
                            <option value="2">2 - Fallacy Finder</option>
                            <option value="3">3 - Fix The Argument</option>
                            <option value="4">4 - Gamified QTE</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Topik Diskusi <span class="text-red-500">*</span></label>
                        <input type="text" name="topik" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-[#7c3aed]/20 focus:border-[#7c3aed] outline-none transition-all font-medium text-slate-700" placeholder="Masukkan topik soal" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Isi Pertanyaan/Kasus <span class="text-red-500">*</span></label>
                    <textarea name="isi_soal" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-[#7c3aed]/20 focus:border-[#7c3aed] outline-none transition-all font-medium text-slate-700" placeholder="Tuliskan isi argumen atau soal di sini..." required></textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Penjelasan (Opsional)</label>
                    <textarea name="penjelasan" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-[#7c3aed]/20 focus:border-[#7c3aed] outline-none transition-all font-medium text-slate-700" placeholder="Tambahkan penjelasan jawaban benar di sini..."></textarea>
                </div>

                <!-- Dynamic Fields -->
                <div id="add_dynamic_fields" class="mt-4 border-t border-slate-100 pt-4 space-y-4"></div>

                <div class="pt-4 flex justify-end gap-3 border-t border-slate-100 mt-6">
                    <button type="button" onclick="closeModal('addModal')" class="px-6 py-2.5 rounded-xl text-slate-600 font-bold hover:bg-slate-100 transition-colors">Batal</button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#7c3aed] text-white font-bold hover:bg-[#6d28d9] transition-all shadow-md shadow-[#7c3aed]/20 hover:-translate-y-0.5">Simpan Soal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Soal -->
    <div id="editModal" class="fixed inset-0 bg-slate-900/60 z-50 hidden items-center justify-center backdrop-blur-md transition-all opacity-0">
        <div class="bg-white w-full max-w-2xl rounded-[2rem] shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300" id="editModalContent">
            <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-white">
                <h3 class="text-xl font-black text-slate-800">Edit Data Soal</h3>
                <button onclick="closeModal('editModal')" class="text-slate-400 hover:text-red-500 rounded-xl p-2 hover:bg-red-50 transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <!-- Form action URL akan diinjeksi lewat Javascript -->
            <form id="editForm" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kategori / ID Latihan <span class="text-red-500">*</span></label>
                        <select name="id_latihan" id="edit_id_latihan" onchange="renderDynamicFields('edit')" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-[#7c3aed]/20 focus:border-[#7c3aed] outline-none transition-all font-medium text-slate-700" required>
                            <option value="1">1 - Argument Builder</option>
                            <option value="2">2 - Fallacy Finder</option>
                            <option value="3">3 - Fix The Argument</option>
                            <option value="4">4 - Gamified QTE</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Topik Diskusi <span class="text-red-500">*</span></label>
                        <input type="text" name="topik" id="edit_topik" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-[#7c3aed]/20 focus:border-[#7c3aed] outline-none transition-all font-medium text-slate-700" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Isi Pertanyaan/Kasus <span class="text-red-500">*</span></label>
                    <textarea name="isi_soal" id="edit_isi_soal" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-[#7c3aed]/20 focus:border-[#7c3aed] outline-none transition-all font-medium text-slate-700" required></textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Penjelasan (Opsional)</label>
                    <textarea name="penjelasan" id="edit_penjelasan" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-[#7c3aed]/20 focus:border-[#7c3aed] outline-none transition-all font-medium text-slate-700"></textarea>
                </div>

                <!-- Dynamic Fields -->
                <div id="edit_dynamic_fields" class="mt-4 border-t border-slate-100 pt-4 space-y-4"></div>

                <div class="pt-4 flex justify-end gap-3 border-t border-slate-100 mt-6">
                    <button type="button" onclick="closeModal('editModal')" class="px-6 py-2.5 rounded-xl text-slate-600 font-bold hover:bg-slate-100 transition-colors">Batal</button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#7c3aed] text-white font-bold hover:bg-[#6d28d9] transition-all shadow-md shadow-[#7c3aed]/20 hover:-translate-y-0.5">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Hapus Soal -->
    <div id="deleteModal" class="fixed inset-0 bg-slate-900/60 z-50 hidden items-center justify-center backdrop-blur-md transition-all opacity-0">
        <div class="bg-white w-full max-w-md rounded-[2rem] shadow-2xl overflow-hidden p-8 text-center transform scale-95 transition-transform duration-300" id="deleteModalContent">
            <div class="w-20 h-20 rounded-full bg-red-50 text-red-500 flex items-center justify-center mx-auto mb-6 shadow-inner">
                <i data-lucide="alert-triangle" class="w-8 h-8"></i>
            </div>
            <h3 class="text-2xl font-black text-slate-800 mb-2">Hapus Soal Ini?</h3>
            <p class="text-sm text-slate-500 mb-8 font-medium">Semua item tebakan atau jawaban yang terkait dengan soal ini juga akan ikut terhapus. Aksi ini tidak dapat dibatalkan.</p>

            <form id="deleteForm" method="POST" class="flex justify-center gap-3">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeModal('deleteModal')" class="px-6 py-3 rounded-xl text-slate-600 font-bold bg-slate-100 hover:bg-slate-200 transition-colors w-full">Batal</button>
                <button type="submit" class="px-6 py-3 rounded-xl bg-red-500 text-white font-bold hover:bg-red-600 transition-all shadow-md shadow-red-500/20 hover:-translate-y-0.5 w-full">Ya, Hapus</button>
            </form>
        </div>
    </div>

    <!-- Logika JavaScript untuk Modal -->
    <script>
        lucide.createIcons();

        function openModal(modalId) {
            const modal = document.getElementById(modalId);

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            setTimeout(() => {
                modal.classList.add('opacity-100');

                document
                    .getElementById(modalId + 'Content')
                    .classList.remove('scale-95');

                document
                    .getElementById(modalId + 'Content')
                    .classList.add('scale-100');
            }, 10);
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);

            modal.classList.remove('opacity-100');

            document
                .getElementById(modalId + 'Content')
                .classList.remove('scale-100');

            document
                .getElementById(modalId + 'Content')
                .classList.add('scale-95');

            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 300);
        }

        function renderDynamicFields(type, data = null) {
            const latihanId = document.getElementById(`${type}_id_latihan`).value;
            const container = document.getElementById(`${type}_dynamic_fields`);
            container.innerHTML = '';

            if (!latihanId) return;

            let html = '<h4 class="text-sm font-bold text-slate-800 mb-2">Pengaturan Jawaban Benar</h4>';
            const inputClass = "w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 focus:ring-4 focus:ring-[#7c3aed]/20 focus:border-[#7c3aed] outline-none transition-all font-medium text-slate-700 text-sm";

            if (latihanId == '1' || latihanId == '3') {
                const claim = data?.builder_claim || '';
                const evidence = data?.builder_evidence || '';
                const reasoning = data?.builder_reasoning || '';
                const reference = data?.builder_reference || '';

                html += `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><label class="block text-xs font-semibold text-slate-700 mb-1">Claim (Klaim)</label><input type="text" name="builder_claim" value="${claim}" class="${inputClass}" required></div>
                        <div><label class="block text-xs font-semibold text-slate-700 mb-1">Evidence (Bukti)</label><input type="text" name="builder_evidence" value="${evidence}" class="${inputClass}" required></div>
                        <div><label class="block text-xs font-semibold text-slate-700 mb-1">Reasoning (Alasan)</label><input type="text" name="builder_reasoning" value="${reasoning}" class="${inputClass}" required></div>
                        <div><label class="block text-xs font-semibold text-slate-700 mb-1">Reference (Referensi)</label><input type="text" name="builder_reference" value="${reference}" class="${inputClass}" required></div>
                    </div>
                `;
            } else if (latihanId == '2') {
                const fallacies = ['Ad Hominem', 'Slippery Slope', 'Strawman', 'False Dilemma', 'Appeal to Emotion', 'Bandwagon', 'Hasty Generalization'];
                let options = '';
                const selected = data?.fallacy_correct || '';
                fallacies.forEach(f => {
                    options += `<option value="${f}" ${selected === f ? 'selected' : ''}>${f}</option>`;
                });
                html += `
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Kesalahan Logika (Jawaban Benar)</label>
                        <select name="fallacy_correct" class="${inputClass}" required><option value="">Pilih Fallacy</option>${options}</select>
                        <p class="text-[11px] text-slate-500 mt-1">* 3 Pilihan salah akan dibuat secara otomatis secara acak.</p>
                    </div>
                `;
            } else if (latihanId == '4') {
                const qteOptions = ['Argumen Logis dan Valid', 'Terdapat Kesalahan Logika (Fallacy)'];
                let options = '';
                const selected = data?.qte_correct || '';
                qteOptions.forEach(o => { options += `<option value="${o}" ${selected === o ? 'selected' : ''}>${o}</option>`; });
                html += `
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Status Argumen (Jawaban Benar)</label>
                        <select name="qte_correct" class="${inputClass}" required><option value="">Pilih Status</option>${options}</select>
                        <p class="text-[11px] text-slate-500 mt-1">* Pilihan salah akan diatur otomatis sebagai opsi sebaliknya.</p>
                    </div>
                `;
            }
            container.innerHTML = html;
        }

        // Mengisi data modal Edit
        function editSoal(item) {
            openModal('editModal');
            // Merakit URL rute pengubahan data menggunakan id soal (Contoh: /admin/soal/5)
            document.getElementById('editForm').action = `/admin/soal/${item.id_soal}`;

            // Menyuntikkan data item ke dalam input form
            document.getElementById('edit_id_latihan').value = item.id_latihan;
            document.getElementById('edit_topik').value = item.topik;
            document.getElementById('edit_isi_soal').value = item.isi_soal;
            document.getElementById('edit_penjelasan').value = item.penjelasan || '';

            let answersData = {};
            if (item.id_latihan == 1 || item.id_latihan == 3) {
                if (item.builder_items) {
                    item.builder_items.forEach(i => {
                        if (i.is_correct) answersData[`builder_${i.tipe}`] = i.isi_item;
                    });
                }
            } else if (item.id_latihan == 2) {
                if (item.fallacy_items) {
                    const correct = item.fallacy_items.find(i => i.is_correct);
                    if (correct) answersData.fallacy_correct = correct.jenis_kesalahan;
                }
            } else if (item.id_latihan == 4) {
                if (item.qte_items) {
                    const correct = item.qte_items.find(i => i.is_correct);
                    if (correct) answersData.qte_correct = correct.isi_item;
                }
            }

            renderDynamicFields('edit', answersData);
        }

        // Merakit data form Hapus
        function deleteSoal(id) {
            openModal('deleteModal');
            document.getElementById('deleteForm').action = `/admin/soal/${id}`;
        }
    </script>
</body>
</html>
