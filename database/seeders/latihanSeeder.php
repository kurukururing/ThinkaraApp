<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class latihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('latihan')->insert([[
                'nama_latihan' => 'Argument Builder',
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'nama_latihan' => 'Fallacy Finder',
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'nama_latihan' => 'Fix the Argument',
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'nama_latihan' => 'Gamified QTE',
                'created_at' => now(),
                'updated_at' => now(),
            ]]);
    }
}
