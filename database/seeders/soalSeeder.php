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
        ]);

        SoalItemBuilder::insert([
            ['id_soal' => $soal1->id_soal, 'isi_item' => 'Penggunaan media sosial yang berlebihan menurunkan rentang perhatian mahasiswa secara signifikan.', 'tipe' => 'claim', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal1->id_soal, 'isi_item' => 'Sebuah studi dari Universitas X menemukan mahasiswa yang menghabiskan >4 jam di medsos memiliki nilai akademik lebih rendah 20%.', 'tipe' => 'evidence', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal1->id_soal, 'isi_item' => 'Hal ini terjadi karena otak terbiasa dengan rangsangan cepat, sehingga kesulitan fokus pada tugas membaca yang panjang.', 'tipe' => 'reasoning', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal1->id_soal, 'isi_item' => 'Journal of Educational Psychology, "Social Media and Attention Span" (2023).', 'tipe' => 'reference', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal1->id_soal, 'isi_item' => 'Media sosial membuat mahasiswa memiliki lebih banyak teman.', 'tipe' => 'claim', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 2. Soal Lain untuk Argument Builder & Fix The Argument
        // 2. Soal Lain untuk Argument Builder (ID Latihan = 1)
        $soal2 = Soal::create([
            'id_latihan' => 1,
            'topik' => 'Pembelajaran Berbasis Proyek (Project-Based Learning)',
            'isi_soal'=>'Pendekatan pembelajaran berbasis proyek telah banyak diterapkan dalam sistem pendidikan modern untuk meningkatkan keterlibatan siswa secara aktif. Model ini menekankan pada penyelesaian masalah nyata melalui kolaborasi.',
        ]);

        SoalItemBuilder::insert([
            ['id_soal' => $soal2->id_soal, 'isi_item' => 'Pembelajaran berbasis proyek (PBL) sangat efektif dalam mengasah kemampuan berpikir kritis siswa.', 'tipe' => 'claim', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal2->id_soal, 'isi_item' => 'Data dari Kemendikbudristek 2022 menunjukkan peningkatan persentase kelulusan dengan nilai memuaskan pada sekolah yang menerapkan PBL.', 'tipe' => 'evidence', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal2->id_soal, 'isi_item' => 'Dengan memecahkan kasus dunia nyata, siswa tidak hanya menghafal, tetapi dituntut menganalisis dan mencari solusi mandiri.', 'tipe' => 'reasoning', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal2->id_soal, 'isi_item' => 'Buku "Panduan Implementasi PBL di Sekolah Menengah" (2022).', 'tipe' => 'reference', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal2->id_soal, 'isi_item' => 'PBL memakan waktu terlalu lama dan biaya terlalu besar.', 'tipe' => 'claim', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 3. Soal untuk Fallacy Finder
        // 3. Soal untuk Fallacy Finder (ID Latihan = 2)
        $soal3 = Soal::create([
            'id_latihan' => 1,
            'id_latihan' => 2,
            'topik' => 'Aturan Pembatasan Kendaraan Pribadi di Kampus',
            'isi_soal'=>'Seorang mahasiswa memprotes kebijakan rektorat: "Jika rektorat mulai melarang kita membawa motor ke kampus hari ini, besok mereka akan melarang kita makan di kantin, dan pada akhirnya mereka akan mengatur jam tidur kita! Kebijakan ini harus dibatalkan!"',
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
            'id_latihan' => 1,
            'id_latihan' => 2,
            'topik' => 'Perdebatan Pemilihan Ketua BEM',
            'isi_soal'=>'Salah satu kandidat berkata dalam debat: "Kita tidak perlu mendengarkan usulan program kerja dari kandidat nomor 2, dia kan mahasiswa baru yang nilai IPK-nya pas-pasan!"',
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
        ]);

        SoalItemBuilder::insert([
            ['id_soal' => $soal5->id_soal, 'isi_item' => 'Sarapan yang bergizi di pagi hari dapat meningkatkan produktivitas dan fokus kerja seseorang.', 'tipe' => 'claim', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal5->id_soal, 'isi_item' => 'Data dari Kementerian Kesehatan menunjukkan bahwa individu yang rutin sarapan memiliki tingkat konsentrasi 30% lebih tinggi.', 'tipe' => 'evidence', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal5->id_soal, 'isi_item' => 'Hal ini disebabkan karena asupan karbohidrat di pagi hari mengembalikan kadar glukosa darah yang menjadi sumber bahan bakar utama otak.', 'tipe' => 'reasoning', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal5->id_soal, 'isi_item' => 'Buku "Nutrisi dan Kinerja Otak" (2021).', 'tipe' => 'reference', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal5->id_soal, 'isi_item' => 'Sarapan hanya membuat perut terasa penuh dan mengantuk.', 'tipe' => 'claim', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 6. Soal untuk Gamified QTE (ID Latihan = 4)
        $soal6 = Soal::create([
            'id_latihan' => 4,
            'topik' => 'Evaluasi Kecepatan Argumen Logis',
            'isi_soal'=>'Perhatikan argumen berikut secara cepat. Apakah pernyataan ini memuat argumen yang valid atau kesesatan logika? "Semua orang sukses bangun jam 5 pagi. Jika kamu tidak bangun jam 5 pagi, kamu tidak akan pernah sukses."',
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
        ]);

        SoalItemQte::insert([
            ['id_soal' => $soal7->id_soal, 'isi_item' => 'Argumen Logis dan Valid', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id_soal' => $soal7->id_soal, 'isi_item' => 'Terdapat Kesalahan Logika (Fallacy)', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
