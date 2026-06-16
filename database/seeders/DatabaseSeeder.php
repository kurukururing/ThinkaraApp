<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(akunSeeder::class);
        $this->call(mahasiswaSeeder::class);
        $this->call(latihanSeeder::class);
        $this->call(soalSeeder::class);
        $this->call(hasilSesiSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(DosenSeeder::class);
    }
}
