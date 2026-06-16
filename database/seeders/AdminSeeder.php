<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menggunakan updateOrInsert dengan Query Builder untuk menghindari masalah mutator/fillable di model Akun
        DB::table('akun')->updateOrInsert(
            ['username' => 'admin1'], // Cari akun berdasarkan username 'admin'
            [
                'email' => 'admin@thinkara.com',
                'password' => Hash::make('admin1'), // Ini akan mengenkripsi password
                'user_role' => 'admin',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}