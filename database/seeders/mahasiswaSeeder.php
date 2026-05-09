<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mahasiswa')->insert([[
            'id_akun' => 1,
            'npm'=>'1',
            'nama_mahasiswa'=>'Axel',
            'jenis_kelamin'=>'laki-laki',
            'jenjang'=>'S1',
            'tanggal_lahir'=>'2005-11-22',
            'instansi'=>'UPNVJT',
            'created_at'=>now(),
            'updated_at'=>now(),
        ],[
            'id_akun' => 2,
            'npm'=>'2',
            'nama_mahasiswa'=>'Budiman',
            'jenis_kelamin'=>'laki-laki',
            'jenjang'=>'S1',
            'tanggal_lahir'=>'2005-11-23',
            'instansi'=>'UPNVJT',
            'created_at'=>now(),
            'updated_at'=>now(),
        ],[
            'id_akun' => 3,
            'npm'=>'3',
            'nama_mahasiswa'=>'Ayu',
            'jenis_kelamin'=>'perempuan',
            'jenjang'=>'S1',
            'tanggal_lahir'=>'2005-11-24',
            'instansi'=>'UPNVJT',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]]);
    }
}
