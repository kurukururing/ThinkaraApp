<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class hasilSesiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hasil_sesi_latihan')->insert([
            [
                'id_akun' => 1,
                'id_latihan' => 1,
                'xp' => 75,
                'skor' => 178,
                'waktu_main' => now(),
                'durasi' => 180,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
