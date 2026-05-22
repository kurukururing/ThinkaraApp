<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Soal;
use App\Models\SoalItemBuilder;
use App\Models\SoalItemFallacy;
use App\Models\SoalItemQte;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Soal untuk Argument Builder & Fix The Argument
        // 1. Soal untuk Argument Builder (ID Latihan = 1)
        $soal1 = Soal::create([
            'id_latihan' => 1,
            'topik' => 'Dampak Media Sosial terhadap Konsentrasi Belajar',
            'isi_soal'=>'Penggunaan media sosial di kalangan mahasiswa mengalami peningkatan signifikan dalam beberapa tahun terakhir. Beberapa studi menunjukkan bahwa paparan konten yang terus-menerus dapat menyebabkan penurunan kapasitas perhatian.',
            'penjelasan' => 'Struktur argumen yang benar diawali dengan Klaim (pernyataan utama), diikuti dengan Evidence (bukti berupa studi/data pendukung), Reasoning (alasan logis yang menghubungkan bukti dan klaim), dan diakhiri dengan Reference (sumber referensi yang valid).',
        ]);

        SoalItemBuilder::insert([
            ['id_soal' => $soal1->id_soal, 'isi_item' => 'Penggunaan media sosial yang berlebihan menurunkan rentang perhatian mahasiswa secara signifikan.', 'tipe' => 'claim', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal1->id_soal, 'isi_item' => 'Sebuah studi dari Universitas X menemukan mahasiswa yang menghabiskan >4 jam di medsos memiliki nilai akademik lebih rendah 20%.', 'tipe' => 'evidence', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal1->id_soal, 'isi_item' => 'Hal ini terjadi karena otak terbiasa dengan rangsangan cepat, sehingga kesulitan fokus pada tugas membaca yang panjang.', 'tipe' => 'reasoning', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal1->id_soal, 'isi_item' => 'Journal of Educational Psychology, "Social Media and Attention Span" (2023).', 'tipe' => 'reference', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 2. Soal Lain untuk Argument Builder & Fix The Argument
        // 2. Soal Lain untuk Argument Builder (ID Latihan = 1)
        $soal2 = Soal::create([
            'id_latihan' => 1,
            'topik' => 'Pembelajaran Berbasis Proyek (Project-Based Learning)',
            'isi_soal'=>'Pendekatan pembelajaran berbasis proyek telah banyak diterapkan dalam sistem pendidikan modern untuk meningkatkan keterlibatan siswa secara aktif. Model ini menekankan pada penyelesaian masalah nyata melalui kolaborasi.',
            'penjelasan' => 'Pembelajaran berbasis proyek (PBL) mendorong kemampuan berpikir kritis. Susunan argumen yang tepat adalah mengemukakan klaim, memberikan bukti dari data Kemendikbudristek, menyambungkannya dengan alasan analitis (reasoning), dan mencantumkan sumber buku panduan sebagai referensi.',
        ]);

        SoalItemBuilder::insert([
            ['id_soal' => $soal2->id_soal, 'isi_item' => 'Pembelajaran berbasis proyek (PBL) sangat efektif dalam mengasah kemampuan berpikir kritis siswa.', 'tipe' => 'claim', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal2->id_soal, 'isi_item' => 'Data dari Kemendikbudristek 2022 menunjukkan peningkatan persentase kelulusan dengan nilai memuaskan pada sekolah yang menerapkan PBL.', 'tipe' => 'evidence', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal2->id_soal, 'isi_item' => 'Dengan memecahkan kasus dunia nyata, siswa tidak hanya menghafal, tetapi dituntut menganalisis dan mencari solusi mandiri.', 'tipe' => 'reasoning', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal2->id_soal, 'isi_item' => 'Buku "Panduan Implementasi PBL di Sekolah Menengah" (2022).', 'tipe' => 'reference', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 3. Soal untuk Fallacy Finder
        // 3. Soal untuk Fallacy Finder (ID Latihan = 2)
        $soal3 = Soal::create([
            'id_latihan' => 2,
            'topik' => 'Aturan Pembatasan Kendaraan Pribadi di Kampus',
            'isi_soal'=>'Seorang mahasiswa memprotes kebijakan rektorat: "Jika rektorat mulai melarang kita membawa motor ke kampus hari ini, besok mereka akan melarang kita makan di kantin, dan pada akhirnya mereka akan mengatur jam tidur kita! Kebijakan ini harus dibatalkan!"',
            'penjelasan' => 'Argumen tersebut mengandung cacat logika Slippery Slope (Lereng Licin), di mana penutur berasumsi bahwa satu kejadian kecil (melarang motor) akan memicu rentetan kejadian ekstrem lainnya (melarang makan di kantin, mengatur jam tidur) tanpa adanya bukti logis yang menghubungkannya.',
        ]);

        SoalItemFallacy::insert([
            ['id_soal' => $soal3->id_soal, 'jenis_kesalahan' => 'Slippery Slope', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal3->id_soal, 'jenis_kesalahan' => 'Ad Hominem', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal3->id_soal, 'jenis_kesalahan' => 'Strawman', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal3->id_soal, 'jenis_kesalahan' => 'False Dilemma', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 4. Soal Lain untuk Fallacy Finder
        // 4. Soal Lain untuk Fallacy Finder (ID Latihan = 2)
        $soal4 = Soal::create([
            'id_latihan' => 2,
            'topik' => 'Perdebatan Pemilihan Ketua BEM',
            'isi_soal'=>'Salah satu kandidat berkata dalam debat: "Kita tidak perlu mendengarkan usulan program kerja dari kandidat nomor 2, dia kan mahasiswa baru yang nilai IPK-nya pas-pasan!"',
            'penjelasan' => 'Pernyataan tersebut adalah cacat logika Ad Hominem. Pembicara menyerang pribadi lawannya (mahasiswa baru, IPK pas-pasan) untuk menjatuhkan argumennya, alih-alih fokus pada substansi atau program kerja yang ditawarkan.',
        ]);

        SoalItemFallacy::insert([
            ['id_soal' => $soal4->id_soal, 'jenis_kesalahan' => 'Ad Hominem', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal4->id_soal, 'jenis_kesalahan' => 'Appeal to Emotion', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal4->id_soal, 'jenis_kesalahan' => 'Bandwagon', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal4->id_soal, 'jenis_kesalahan' => 'Hasty Generalization', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 5. Soal untuk Fix The Argument (ID Latihan = 3)
        $soal5 = Soal::create([
            'id_latihan' => 3,
            'topik' => 'Pentingnya Sarapan Sebelum Memulai Aktivitas',
            'isi_soal'=>'Banyak orang melewatkan sarapan dengan alasan terburu-buru, namun sarapan memiliki peran penting bagi tubuh. Beberapa ahli gizi menyebutkan bahwa energi yang cukup di pagi hari meningkatkan produktivitas.',
            'penjelasan' => 'Klaim utama adalah sarapan meningkatkan produktivitas. Ini dibuktikan dengan data Kemenkes (Evidence), lalu dijelaskan mengapa bisa terjadi melalui mekanisme glukosa otak (Reasoning), dan diperkuat dengan kutipan dari buku Nutrisi (Reference).',
        ]);

        SoalItemBuilder::insert([
            ['id_soal' => $soal5->id_soal, 'isi_item' => 'Sarapan yang bergizi di pagi hari dapat meningkatkan produktivitas dan fokus kerja seseorang.', 'tipe' => 'claim', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal5->id_soal, 'isi_item' => 'Data dari Kementerian Kesehatan menunjukkan bahwa individu yang rutin sarapan memiliki tingkat konsentrasi 30% lebih tinggi.', 'tipe' => 'evidence', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal5->id_soal, 'isi_item' => 'Hal ini disebabkan karena asupan karbohidrat di pagi hari mengembalikan kadar glukosa darah yang menjadi sumber bahan bakar utama otak.', 'tipe' => 'reasoning', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal5->id_soal, 'isi_item' => 'Buku "Nutrisi dan Kinerja Otak" (2021).', 'tipe' => 'reference', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 6. Soal untuk Gamified QTE (ID Latihan = 4)
        $soal6 = Soal::create([
            'id_latihan' => 4,
            'topik' => 'Evaluasi Kecepatan Argumen Logis',
            'isi_soal'=>'Perhatikan argumen berikut secara cepat. Apakah pernyataan ini memuat argumen yang valid atau kesesatan logika? "Semua orang sukses bangun jam 5 pagi. Jika kamu tidak bangun jam 5 pagi, kamu tidak akan pernah sukses."',
            'penjelasan' => 'Argumen ini mengandung cacat logika (Fallacy) jenis Hasty Generalization atau False Dilemma. Pernyataan tersebut menyamaratakan dan menyimpulkan secara mutlak bahwa tanpa bangun jam 5 pagi, seseorang mustahil sukses.',
        ]);

        SoalItemQte::insert([
            ['id_soal' => $soal6->id_soal, 'isi_item' => 'Terdapat Kesalahan Logika (Fallacy)', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal6->id_soal, 'isi_item' => 'Argumen Logis dan Valid', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 7. Soal Lain Gamified QTE (ID Latihan = 4)
        $soal7 = Soal::create([
            'id_latihan' => 4,
            'topik' => 'Evaluasi Kecepatan Argumen Logis',
            'isi_soal'=>'Membaca buku setiap hari dapat memperluas kosa kata karena kita terpapar pada berbagai istilah baru yang tidak selalu muncul dalam percakapan sehari-hari.',
            'penjelasan' => 'Argumen ini logis dan valid. Terdapat korelasi yang jelas dan kausalitas yang masuk akal antara membaca buku setiap hari, paparan istilah baru, dengan perluasan kosa kata.',
        ]);

        SoalItemQte::insert([
            ['id_soal' => $soal7->id_soal, 'isi_item' => 'Argumen Logis dan Valid', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal7->id_soal, 'isi_item' => 'Terdapat Kesalahan Logika (Fallacy)', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
