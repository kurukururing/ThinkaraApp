<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menggunakan updateOrInsert dengan Query Builder untuk menghindari masalah mutator/fillable di model Akun
        DB::table('akun')->updateOrInsert(
            ['username' => 'asep'], // Cari akun berdasarkan username 'asep'
            [
                'email' => 'dosen1@thinkara.com',
                'password' => Hash::make('dosen1'), // Ini akan mengenkripsi password
                'user_role' => 'dosen',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
