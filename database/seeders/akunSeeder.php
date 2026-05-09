<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class akunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('akun')->insert([
            'username' => 'Axel',
            'email' => '1@1',
            'password' => Hash::make('1'),
            'user_role' => 'mahasiswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
