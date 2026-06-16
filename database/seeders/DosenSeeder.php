<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Akun;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Akun::updateOrCreate(
            ['username' => 'asep'], // Cari akun berdasarkan username 'admin'
            [
                'email' => 'dosen1@thinkara.com',
                'password' => Hash::make('dosen1'), // Ini akan mengenkripsi password
                'user_role' => 'dosen',
                'is_active' => 1,
            ]
        );
    }
}
