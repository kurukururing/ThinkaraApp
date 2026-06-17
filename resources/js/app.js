document.addEventListener('DOMContentLoaded', function () {
    // Mengambil CSRF Token dari meta tag untuk keamanan request AJAX
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // --- General Timer Logic (Berlaku untuk semua halaman latihan yang memiliki timer) ---
    const timerDisplays = document.querySelectorAll('#qte-timer, .timer-display, [id$="-timer"]');
    timerDisplays.forEach(display => {
        let textParts = display.textContent.split(':');
        let minutes = 10;
        let seconds = 0;
        
        if (textParts.length === 2) {
            minutes = parseInt(textParts[0].trim());
            seconds = parseInt(textParts[1].trim());
            if(isNaN(minutes)) minutes = 10;
            if(isNaN(seconds)) seconds = 0;
        }
        
        let timer = (minutes * 60) + seconds;
        if (timer > 0) {
            const interval = setInterval(function () {
                let m = parseInt(timer / 60, 10);
                let s = parseInt(timer % 60, 10);
                m = m < 10 ? "0" + m : m;
                s = s < 10 ? "0" + s : s;
                display.textContent = m + " : " + s;
                if (--timer < 0) {
                    clearInterval(interval);
                }
            }, 1000);
        }
    });

    // --- Logika untuk Halaman Fix The Argument (fixargument.blade.php) ---
    const fixArgumentPage = document.getElementById('fix-argument-page');
    if (fixArgumentPage) {
        const pilihanContainer = document.getElementById('pilihan-jawaban-container');
        const perbaikanContainer = document.getElementById('area-perbaikan-container');
        const submitBtn = document.getElementById('kirim-fix-argument');
        const soalId = fixArgumentPage.dataset.soalId;
        const startTimeFixArgument = Date.now();

        const choiceItems = document.querySelectorAll('.choice-item');
        
        // Menambahkan atribut draggable dan event listener ke setiap elemen
        choiceItems.forEach(item => {
            item.setAttribute('draggable', 'true');
            item.style.cursor = 'grab';
            
            item.addEventListener('dragstart', (e) => {
                item.classList.add('dragging');
                item.style.opacity = '0.5';
                if (e.dataTransfer) {
                    e.dataTransfer.effectAllowed = 'move';
                    e.dataTransfer.setData('text/plain', item.dataset.id || 'item');
                }
            });
            
            item.addEventListener('dragend', () => {
                item.classList.remove('dragging');
                item.style.opacity = '1';
                
                const placeholder = perbaikanContainer.querySelector('.placeholder');
                if (placeholder) {
                    placeholder.style.display = perbaikanContainer.querySelectorAll('.choice-item').length > 0 ? 'none' : 'block';
                }
            });
        });

        // Reorder (pindah susunan) HANYA diaktifkan di perbaikan area (list vertikal)
        perbaikanContainer.addEventListener('dragenter', e => e.preventDefault());
        perbaikanContainer.addEventListener('dragover', e => {
            e.preventDefault();
            if (e.dataTransfer) e.dataTransfer.dropEffect = 'move';
            const afterElement = getDragAfterElement(perbaikanContainer, e.clientY);
            const draggable = document.querySelector('.dragging');
            if (draggable) {
                if (afterElement == null) {
                    perbaikanContainer.appendChild(draggable);
                } else {
                    perbaikanContainer.insertBefore(draggable, afterElement);
                }
            }
        });

        // Container pilihan hanya berfungsi menerima elemen tanpa kalkulasi posisi 
        pilihanContainer.addEventListener('dragenter', e => e.preventDefault());
        pilihanContainer.addEventListener('dragover', e => {
            e.preventDefault();
            if (e.dataTransfer) e.dataTransfer.dropEffect = 'move';
        });
        pilihanContainer.addEventListener('drop', e => {
            e.preventDefault();
            const draggable = document.querySelector('.dragging');
            if (draggable) pilihanContainer.appendChild(draggable);
        });

        // Fungsi untuk mengirim jawaban
        submitBtn.addEventListener('click', function () {
            const answerItems = perbaikanContainer.querySelectorAll('.choice-item');
            const answerIds = Array.from(answerItems).map(item => item.dataset.id);

            const TotalJawabanFix = 4;
            if (answerIds.length === 0) {
                alert('Silakan susun argumen terlebih dahulu.');
                return;
            } else if (answerIds.length < TotalJawabanFix) {
                alert('Harap masukkan semua elemen penyusun argumen sebelum mengirim.');
                return;
            }

            // Hitung durasi
            const endTime = Date.now();
            const durationInSeconds = Math.round((endTime - startTimeFixArgument) / 1000);

            fetch(`/fixargument/${soalId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ jawaban_items: answerIds, durasiFix: durationInSeconds })
            })
            .then(response => response.json())
            .then(data => {
                if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengirim jawaban.');
            });
        });
    }

    // --- Logika untuk Halaman Argument Builder (argumentbuilder.blade.php) ---
    const argumentBuilderPage = document.getElementById('argument-builder-page');
    if (argumentBuilderPage) {
        const pilihanContainer = document.getElementById('pilihan-jawaban-container');
        const dropZones = document.querySelectorAll('.builder-drop-zone');
        const submitBtn = document.getElementById('kirim-argument-builder');
        const soalId = argumentBuilderPage.dataset.soalId;
        const startTimeArgumentBuilder = Date.now();

        const choiceItems = document.querySelectorAll('.choice-item');
        
        choiceItems.forEach(item => {
            item.setAttribute('draggable', 'true');
            item.style.cursor = 'grab';
            item.addEventListener('dragstart', (e) => {
                item.classList.add('dragging');
                item.style.opacity = '0.5';
                if (e.dataTransfer) {
                    e.dataTransfer.effectAllowed = 'move';
                    e.dataTransfer.setData('text/plain', item.dataset.id || 'item');
                }
            });
            item.addEventListener('dragend', () => {
                item.classList.remove('dragging');
                item.style.opacity = '1';
                updateBuilderPlaceholders();
            });
        });

        function updateBuilderPlaceholders() {
            dropZones.forEach(zone => {
                const placeholder = zone.querySelector('.placeholder');
                if (placeholder) {
                    placeholder.style.display = zone.querySelectorAll('.choice-item').length > 0 ? 'none' : 'block';
                }
            });
        }

        // Pilihan awal berfungsi menerima elemen balik
        pilihanContainer.addEventListener('dragenter', e => e.preventDefault());
        pilihanContainer.addEventListener('dragover', e => {
            e.preventDefault();
            if (e.dataTransfer) e.dataTransfer.dropEffect = 'move';
        });
        pilihanContainer.addEventListener('drop', e => {
            e.preventDefault();
            const draggable = document.querySelector('.dragging');
            if (draggable) pilihanContainer.appendChild(draggable);
        });

        // Masing-masing kotak (Claim, dll) hanya bisa menerima 1 elemen
        dropZones.forEach(zone => {
            zone.addEventListener('dragenter', e => e.preventDefault());
            zone.addEventListener('dragover', e => {
                e.preventDefault();
                if (e.dataTransfer) e.dataTransfer.dropEffect = 'move';
            });
            zone.addEventListener('drop', e => {
                e.preventDefault();
                const draggable = document.querySelector('.dragging');
                if (draggable) {
                    const existingItem = zone.querySelector('.choice-item');
                    if (existingItem && existingItem !== draggable) pilihanContainer.appendChild(existingItem);
                    zone.appendChild(draggable);
                    updateBuilderPlaceholders();
                }
            });
        });

        if (submitBtn) {
            submitBtn.addEventListener('click', function () {
                const answerIds = Array.from(dropZones).map(zone => zone.querySelector('.choice-item')?.dataset.id).filter(id => id);

                if (answerIds.length < dropZones.length) return alert('Harap masukkan semua elemen penyusun argumen sebelum mengirim.');

                // Hitung durasi pengerjaan, waktu sekarang - waktu mulai (milidetik dibagi 1000 = detik)
                const endTime = Date.now();
                const durationInSeconds = Math.round((endTime - startTimeArgumentBuilder) / 1000);

                fetch(`/argumentbuilder/${soalId}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                    body: JSON.stringify({ jawaban_items: answerIds, durasiBuilder: durationInSeconds })
                }).then(res => res.json()).then(data => {
                    if (data.redirect_url) {
                        window.location.href = data.redirect_url;
                    }
                }).catch(err => console.error(err));
            });
        }
    }

    // --- Logika untuk Halaman Fallacy Finder (fallacyfinder.blade.php) ---
    const fallacyFinderPage = document.getElementById('fallacy-finder-page');
    if (fallacyFinderPage) {
        const pilihanContainer = document.getElementById('pilihan-ganda-container');
        const submitBtn = document.getElementById('kirim-fallacy-finder');
        const soalId = fallacyFinderPage.dataset.soalId;
        const startTimeFallacyFinder = Date.now();
        let selectedAnswerId = null;

        // Fungsi untuk memilih jawaban
        pilihanContainer.addEventListener('click', function(e) {
            const button = e.target.closest('.fallacy-choice-btn');
            if (button) {
                // Hapus style terpilih dari semua tombol
                pilihanContainer.querySelectorAll('.fallacy-choice-btn').forEach(btn => {
                    btn.classList.remove('border-[#7c3aed]', 'text-[#7c3aed]', 'bg-[#7c3aed]/10');
                    btn.classList.add('border-slate-200', 'text-slate-600', 'bg-white');
                });

                // Tambahkan style terpilih pada tombol yang diklik
                button.classList.remove('border-slate-200', 'text-slate-600', 'bg-white');
                button.classList.add('border-[#7c3aed]', 'text-[#7c3aed]', 'bg-[#7c3aed]/10');
                selectedAnswerId = button.dataset.id;
            }
        });

        // Fungsi untuk mengirim jawaban
        submitBtn.addEventListener('click', function() {
            if (!selectedAnswerId) {
                alert('Silakan pilih salah satu tipe kesalahan terlebih dahulu.');
                return;
            }

            // Hitung durasi pengerjaan, waktu sekarang - waktu mulai (milidetik dibagi 1000 = detik)
            const endTime = Date.now();
            const durationInSeconds = Math.round((endTime - startTimeFallacyFinder) / 1000);

            fetch(`/fallacyfinder/${soalId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ id_item_fallacy: selectedAnswerId, durasiFallacyFinder: durationInSeconds })
            })
            .then(response => response.json())
            .then(data => {
                if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengirim jawaban.');
            });
        });
    }

    // --- Logika untuk Halaman Gamified QTE (gamifiedqte.blade.php) ---
    const gamifiedQtePage = document.getElementById('gamified-qte-page');
    if (gamifiedQtePage) {
        const pilihanContainer = document.getElementById('qte-pilihan-container');
        const dropZones = document.querySelectorAll('.qte-drop-zone');
        const submitBtn = document.getElementById('kirim-gamified-qte');
        const soalId = gamifiedQtePage.dataset.soalId;
        const startTimeGamifiedQte = Date.now();

        const choiceItems = document.querySelectorAll('.qte-choice-item');
        
        choiceItems.forEach(item => {
            item.addEventListener('dragstart', (e) => {
                item.classList.add('dragging');
                item.style.opacity = '0.5';
                if (e.dataTransfer) {
                    e.dataTransfer.effectAllowed = 'move';
                    e.dataTransfer.setData('text/plain', item.dataset.id || 'item');
                }
            });
            item.addEventListener('dragend', () => {
                item.classList.remove('dragging');
                item.style.opacity = '1';
            });
        });

        if (pilihanContainer) {
            pilihanContainer.addEventListener('dragenter', e => e.preventDefault());
            pilihanContainer.addEventListener('dragover', e => {
                e.preventDefault();
                if (e.dataTransfer) e.dataTransfer.dropEffect = 'move';
            });
            pilihanContainer.addEventListener('drop', e => {
                e.preventDefault();
                const draggable = document.querySelector('.dragging');
                if (draggable) pilihanContainer.appendChild(draggable);
            });
        }

        dropZones.forEach(zone => {
            zone.addEventListener('dragenter', e => e.preventDefault());
            zone.addEventListener('dragover', e => {
                e.preventDefault();
                if (e.dataTransfer) e.dataTransfer.dropEffect = 'move';
            });
            zone.addEventListener('drop', e => {
                e.preventDefault();
                const draggable = document.querySelector('.dragging');
                if (draggable) {
                    const existingItem = zone.querySelector('.qte-choice-item');
                    if (existingItem && existingItem !== draggable) {
                        pilihanContainer.appendChild(existingItem);
                    }
                    zone.appendChild(draggable);
                }
            });
        });

        if (submitBtn) {
            submitBtn.addEventListener('click', function() {
                const answerItem = document.querySelector('.qte-drop-zone .qte-choice-item');
                if (!answerItem) {
                    alert('Silakan seret (drag) salah satu jawaban ke bagian yang kosong.');
                    return;
                }
                const selectedQteAnswerId = answerItem.dataset.id;
                
                // Hitung durasi
                const endTime = Date.now();
                const durationInSeconds = Math.round((endTime - startTimeGamifiedQte) / 1000);

                fetch(`/gamifiedqte/${soalId}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                    body: JSON.stringify({ id_item_qte: selectedQteAnswerId, durasiQte: durationInSeconds })
                }).then(res => res.json()).then(data => {
                    if (data.redirect_url) {
                        window.location.href = data.redirect_url;
                    }
                }).catch(err => console.error(err));
            });
        }
    }

    // Fungsi pendukung untuk menentukan posisi elemen yang di-drag
    function getDragAfterElement(container, y) {
        const draggableElements = [...container.querySelectorAll('.choice-item:not(.dragging)')];

        return draggableElements.reduce((closest, child) => {
            const box = child.getBoundingClientRect();
            const offset = y - box.top - box.height / 2;
            if (offset < 0 && offset > closest.offset) {
                return { offset: offset, element: child };
            } else {
                return closest;
            }
        }, { offset: Number.NEGATIVE_INFINITY }).element;
    }

    // --- Logika Modal Konfirmasi Logout ---
    const btnLogout = document.getElementById('btn-logout');
    const formLogout = document.getElementById('form-logout');

    if (btnLogout && formLogout) {
        btnLogout.addEventListener('click', function () {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Keluar dari Akun?',
                    text: "Sesi Anda akan diakhiri dan Anda harus login kembali.",
                    icon: 'question',
                    iconColor: '#7c3aed', // Warna ungu tema
                    showCancelButton: true,
                    confirmButtonColor: '#7c3aed',
                    cancelButtonColor: '#f1f5f9', // Warna abu-abu terang
                    confirmButtonText: '<span style="font-weight: 700; color: white;">Ya, Keluar</span>',
                    cancelButtonText: '<span style="font-weight: 700; color: #475569;">Batal</span>',
                    reverseButtons: true, // Menukar posisi tombol agar "Ya" ada di kanan
                    backdrop: `rgba(15, 23, 42, 0.4)`,
                    customClass: {
                        popup: 'rounded-3xl border border-slate-100 shadow-md',
                        title: 'text-lg font-black text-slate-800 pt-2',
                        htmlContainer: 'text-sm font-semibold text-slate-500',
                        confirmButton: 'rounded-xl px-6 py-2.5',
                        cancelButton: 'rounded-xl px-6 py-2.5 border border-slate-200',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        formLogout.submit();
                    }
                });
            } else {
                // Fallback menggunakan modal bawaan JS
                if (confirm('Apakah Anda yakin ingin keluar dari aplikasi?')) {
                    formLogout.submit();
                }
            }
        });
    }

    // --- Logika Modal Konfirmasi Hapus Akun ---
    const btnDeleteAkun = document.getElementById('btn-delete-akun');
    const formDeleteAkun = document.getElementById('form-delete-akun');

    if (btnDeleteAkun && formDeleteAkun) {
        btnDeleteAkun.addEventListener('click', function () {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Hapus Akun Permanen?',
                    text: "Semua data latihan akan hilang. Tindakan ini tidak dapat dibatalkan!",
                    icon: 'warning',
                    iconColor: '#e11d48', // Warna merah destruktif
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#f1f5f9',
                    confirmButtonText: '<span style="font-weight: 700; color: white;">Ya, Hapus Akun</span>',
                    cancelButtonText: '<span style="font-weight: 700; color: #475569;">Batal</span>',
                    reverseButtons: true,
                    backdrop: `rgba(15, 23, 42, 0.6)`,
                    customClass: {
                        popup: 'rounded-3xl border border-slate-100 shadow-md',
                        title: 'text-lg font-black text-slate-800 pt-2',
                        htmlContainer: 'text-sm font-semibold text-slate-500',
                        confirmButton: 'rounded-xl px-6 py-2.5',
                        cancelButton: 'rounded-xl px-6 py-2.5 border border-slate-200',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        formDeleteAkun.submit();
                    }
                });
            } else {
                // Fallback menggunakan modal bawaan JS
                if (confirm('Peringatan: Apakah Anda yakin ingin menonaktifkan akun ini? Tindakan ini tidak dapat dibatalkan.')) {
                    formDeleteAkun.submit();
                }
            }
        });
    }

    // Logika untuk Halaman Dosen: Manajemen Quiz
    const dosenQuizPage = document.getElementById('formBuatQuiz');
    if (dosenQuizPage) {
 
        // 1. Custom Dropdown Jenis Latihan
        const btnTrigger     = document.getElementById('btnDropdownTrigger');
        const dropdownPanel  = document.getElementById('dropdownPanel');
        const dropdownLabel  = document.getElementById('dropdownLabel');
        const dropdownChevron = document.getElementById('dropdownChevron');
        const hiddenIdLatihan = document.getElementById('hiddenIdLatihan');
 
        function openDropdown() {
            dropdownPanel.classList.remove('hidden');
            requestAnimationFrame(() => {
                dropdownPanel.classList.remove('opacity-0', '-translate-y-2');
                dropdownPanel.classList.add('opacity-100', 'translate-y-0');
            });
            dropdownChevron.classList.add('rotate-180');
            btnTrigger.classList.add('border-brand');
        }
 
        function closeDropdown() {
            dropdownPanel.classList.remove('opacity-100', 'translate-y-0');
            dropdownPanel.classList.add('opacity-0', '-translate-y-2');
            dropdownChevron.classList.remove('rotate-180');
            btnTrigger.classList.remove('border-brand');
            // Sembunyikan setelah animasi selesai
            setTimeout(() => dropdownPanel.classList.add('hidden'), 200);
        }
 
        btnTrigger.addEventListener('click', function () {
            const isOpen = !dropdownPanel.classList.contains('hidden');
            isOpen ? closeDropdown() : openDropdown();
        });
 
        // Tutup dropdown jika klik di luar
        document.addEventListener('click', function (e) {
            const wrapper = document.getElementById('dropdownJenisLatihan');
            if (wrapper && !wrapper.contains(e.target)) {
                closeDropdown();
            }
        });
 
        // Pilih opsi dari dropdown
        document.querySelectorAll('.dropdown-option').forEach(function (option) {
            option.addEventListener('click', function () {
                const id    = this.dataset.id;
                const label = this.dataset.label;
 
                // Set nilai hidden input
                hiddenIdLatihan.value = id;
 
                // Update label tombol trigger
                dropdownLabel.textContent = label;
                btnTrigger.classList.remove('text-slate-400');
                btnTrigger.classList.add('text-slate-700');
 
                // Tampilkan centang hanya pada opsi terpilih
                document.querySelectorAll('.dropdown-option').forEach(function (opt) {
                    opt.querySelector('.check-icon').classList.add('hidden');
                });
                this.querySelector('.check-icon').classList.remove('hidden');
 
                closeDropdown();
            });
        });
 
        // Validasi: pastikan jenis latihan sudah dipilih sebelum submit
        dosenQuizPage.addEventListener('submit', function (e) {
            if (!hiddenIdLatihan.value) {
                e.preventDefault();
                // Highlight dropdown sebagai error
                btnTrigger.classList.add('border-red-400', 'ring-2', 'ring-red-200');
                dropdownLabel.classList.add('text-red-400');
                dropdownLabel.textContent = 'Pilih jenis latihan terlebih dahulu';
                // Reset setelah beberapa detik
                setTimeout(function () {
                    btnTrigger.classList.remove('border-red-400', 'ring-2', 'ring-red-200');
                    dropdownLabel.classList.remove('text-red-400');
                    dropdownLabel.textContent = 'Pilih jenis latihan...';
                }, 3000);
            }
        });
 
 
        // 2. Tombol Salin Link Quiz
        document.querySelectorAll('.btn-copy-link').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const url       = this.dataset.url;
                const iconCopy  = this.querySelector('.icon-copy');
                const iconCheck = this.querySelector('.icon-check');
                const feedback  = this.closest('.flex-1.min-w-0').querySelector('.copy-feedback');
 
                navigator.clipboard.writeText(url).then(function () {
                    // Tukar ikon
                    iconCopy.classList.add('hidden');
                    iconCheck.classList.remove('hidden');
                    if (feedback) feedback.classList.remove('hidden');
 
                    // Kembalikan setelah 2 detik
                    setTimeout(function () {
                        iconCopy.classList.remove('hidden');
                        iconCheck.classList.add('hidden');
                        if (feedback) feedback.classList.add('hidden');
                    }, 2000);
                }).catch(function () {
                    // Fallback untuk browser yang tidak support clipboard API
                    alert('Salin link ini secara manual:\n' + url);
                });
            });
        });
 
 
        // 3. Konfirmasi Hapus Quiz (mini popover)
        document.querySelectorAll('.btn-hapus-quiz').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                const wrapper  = this.closest('.relative');
                const popover  = wrapper.querySelector('.confirm-hapus');
 
                // Tutup semua popover lain yang mungkin terbuka
                document.querySelectorAll('.confirm-hapus').forEach(function (p) {
                    if (p !== popover) p.classList.add('hidden');
                });
 
                popover.classList.toggle('hidden');
            });
        });
 
        // Tombol Batal di dalam popover hapus
        document.querySelectorAll('.btn-batal-hapus').forEach(function (btn) {
            btn.addEventListener('click', function () {
                this.closest('.confirm-hapus').classList.add('hidden');
            });
        });
 
        // Tutup popover hapus jika klik di luar
        document.addEventListener('click', function (e) {
            if (!e.target.closest('.btn-hapus-quiz') && !e.target.closest('.confirm-hapus')) {
                document.querySelectorAll('.confirm-hapus').forEach(function (p) {
                    p.classList.add('hidden');
                });
            }
        });
    }
})