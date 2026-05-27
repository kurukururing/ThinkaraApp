<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Akun;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menggunakan updateOrCreate agar jika akun admin sudah ada, passwordnya akan di-reset (ditimpa) dengan yang benar
        Akun::updateOrCreate(
            ['username' => 'admin1'], // Cari akun berdasarkan username 'admin'
            [
                'email' => 'admin@thinkara.com',
                'password' => Hash::make('admin1'), // Ini akan mengenkripsi password
                'user_role' => 'admin',
                'is_active' => 1,
            ]
        );
    }
}