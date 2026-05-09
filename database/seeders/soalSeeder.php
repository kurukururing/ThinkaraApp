<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class soalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('soal')->insert([[
            'id_latihan' => 1,
            'topik' => 'Dampak Media Sosial terhadap Konsentrasi Belajar',
            'isi_soal'=>'Penggunaan media sosial di kalangan mahasiswa mengalami peningkatan 
                         signifikan dalam beberapa tahun terakhir, terutama sejak berkembangnya 
                         platform berbasis video pendek dan interaksi instan. Beberapa studi dalam 
                         bidang psikologi pendidikan menunjukkan bahwa paparan konten yang terus-menerus 
                         dapat menyebabkan penurunan kapasitas perhatian dan meningkatnya kecenderungan 
                         multitasking yang tidak efektif. Selain itu, notifikasi yang muncul secara 
                         berkala juga berkontribusi terhadap gangguan fokus saat proses pembelajaran 
                         berlangsung. Meskipun demikian, media sosial juga memiliki potensi sebagai 
                         sarana berbagi informasi akademik apabila digunakan secara terkontrol dan terarah.',
            'created_at' => now(),
            'updated_at' => now(),
        ],[
            'id_latihan' => 1,
            'topik' => 'Pembelajaran Berbasis Proyek (Project-Based Learning)',
            'isi_soal'=>'Pendekatan pembelajaran berbasis proyek telah banyak diterapkan 
                         dalam sistem pendidikan modern untuk meningkatkan keterlibatan siswa 
                         secara aktif. Model ini menekankan pada penyelesaian masalah nyata melalui 
                         kolaborasi dan eksplorasi mandiri. Penelitian dalam bidang pendidikan 
                         menunjukkan bahwa siswa yang terlibat dalam pembelajaran berbasis proyek 
                         cenderung memiliki pemahaman konsep yang lebih mendalam dibandingkan metode 
                         ceramah tradisional. Selain itu, kemampuan berpikir kritis dan keterampilan 
                         komunikasi juga berkembang lebih baik melalui pendekatan ini karena siswa 
                         didorong untuk mengemukakan ide dan mempertahankan argumennya.',
            'created_at' => now(),
            'updated_at' => now(),
        ]]);
    }
}
