<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use illuminate\Support\Facades\DB;

class soalBuilderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('soal_item_builder')->insert([[
            'id_soal'=>'1',
            'isi_item'=>'Media sosial dapat menurunkan konsentrasi belajar mahasiswa',
            'tipe'=>'claim',
            'is_correct'=>true,
            'created_at'=>now(),
            'updated_at'=>now()
        ],[
            'id_soal'=>'1',
            'isi_item'=>'Paparan konten terus-menerus menurunkan perhatian',
            'tipe'=>'evidence',
            'is_correct'=>true,
            'created_at'=>now(),
            'updated_at'=>now()
        ],[
            'id_soal'=>'1',
            'isi_item'=>'Notifikasi menyebabkan gangguan fokus',
            'tipe'=>'reasoning',
            'is_correct'=>true,
            'created_at'=>now(),
            'updated_at'=>now()
        ],[
            'id_soal'=>'1',
            'isi_item'=>'Studi psikologi pendidikan',
            'tipe'=>'reference',
            'is_correct'=>true,
            'created_at'=>now(),
            'updated_at'=>now()
        ],[
            'id_soal'=>'1',
            'isi_item'=>'Media sosial membuat mahasiswa kreatif',
            'tipe'=>'claim',
            'is_correct'=>false,
            'created_at'=>now(),
            'updated_at'=>now()
        ],[
            'id_soal'=>'2',
            'isi_item'=>'Project-Based Learning meningkatkan pemahaman',
            'tipe'=>'claim',
            'is_correct'=>true,
            'created_at'=>now(),
            'updated_at'=>now()
        ],[
            'id_soal'=>'2',
            'isi_item'=>'Penelitian menunjukkan pemahaman lebih baik',
            'tipe'=>'evidence',
            'is_correct'=>true,
            'created_at'=>now(),
            'updated_at'=>now()
        ],[
            'id_soal'=>'2',
            'isi_item'=>'Siswa aktif menyelesaikan masalah',
            'tipe'=>'reasoning',
            'is_correct'=>true,
            'created_at'=>now(),
            'updated_at'=>now()
        ],[
            'id_soal'=>'2',
            'isi_item'=>'Penelitian pendidikan modern',
            'tipe'=>'reference',
            'is_correct'=>true,
            'created_at'=>now(),
            'updated_at'=>now()
        ],[
            'id_soal'=>'2',
            'isi_item'=>'Siswa suka kerja kelompok',
            'tipe'=>'claim',
            'is_correct'=>false,
            'created_at'=>now(),
            'updated_at'=>now()
        ]]);
    }
}
