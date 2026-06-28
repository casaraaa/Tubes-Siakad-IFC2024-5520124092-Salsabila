<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AkunAdminSeeder::class,
            DosenSeeder::class,
            MahasiswaSeeder::class,
            MataKuliahSeeder::class,
            JadwalSeeder::class,
            KrsSeeder::class,
        ]);
    }
}
