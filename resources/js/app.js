document.addEventListener('DOMContentLoaded', function () {
    // Mengambil CSRF Token dari meta tag untuk keamanan request AJAX
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

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
                    const placeholder = perbaikanContainer.querySelector('.placeholder');
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
                alert(data.message); // Tampilkan pesan dari server
                if (data.is_correct) {
                    window.location.href = '/arena'; // Kembali ke arena jika benar
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
                    alert(data.message);
                    if (data.is_correct) window.location.href = '/arena';
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
                    btn.classList.remove('border-brand', 'text-brand', 'bg-brand/10');
                });

                // Tambahkan style terpilih pada tombol yang diklik
                button.classList.add('border-brand', 'text-brand', 'bg-brand/10');
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
                alert(data.message); // Tampilkan pesan dari server
                if (data.is_correct) {
                    window.location.href = '/arena'; // Kembali ke arena jika benar
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengirim jawaban.');
            });
        });
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
});