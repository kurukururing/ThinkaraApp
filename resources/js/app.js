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

        // Fungsi untuk memindahkan item dari pilihan ke area jawaban
        pilihanContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('choice-item')) {
                perbaikanContainer.appendChild(e.target);
                const placeholder = perbaikanContainer.querySelector('.placeholder');
                if (placeholder) placeholder.style.display = 'none'; // Sembunyikan placeholder
            }
        });

        // Fungsi untuk mengembalikan item dari area jawaban ke pilihan
        perbaikanContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('choice-item')) {
                pilihanContainer.appendChild(e.target);
                // Jika area jawaban kosong, tampilkan lagi placeholder
                if (perbaikanContainer.querySelectorAll('.choice-item').length === 0) {
                    const placeholder = perbaikanContainer.querySelector('.placeholder');
                    if (placeholder) placeholder.style.display = 'block';
                }
            }
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
});