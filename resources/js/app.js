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

            if (answerIds.length === 0) {
                alert('Silakan susun argumen terlebih dahulu.');
                return;
            }

            fetch(`/fixargument/${soalId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ jawaban_items: answerIds })
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
                
                if (answerIds.length < dropZones.length) return alert('Harap isi semua bagian argumen sebelum mengirim.');

                fetch(`/argumentbuilder/${soalId}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                    body: JSON.stringify({ jawaban_items: answerIds })
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

            fetch(`/fallacyfinder/${soalId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ id_item_fallacy: selectedAnswerId })
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

                fetch(`/gamifiedqte/${soalId}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                    body: JSON.stringify({ id_item_qte: selectedQteAnswerId })
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
})