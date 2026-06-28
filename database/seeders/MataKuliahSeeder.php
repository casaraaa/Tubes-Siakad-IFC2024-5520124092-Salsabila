<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->dataMataKuliah() as $baris) {
            MataKuliah::create($baris);
        }
    }

    private function dataMataKuliah(): array
    {
        return [
            ['kode_matakuliah' => 'IF53413', 'nama_matakuliah' => 'Pengembangan Web II', 'sks' => 3],
            ['kode_matakuliah' => 'IF53201', 'nama_matakuliah' => 'Basis Data', 'sks' => 3],
            ['kode_matakuliah' => 'IF53310', 'nama_matakuliah' => 'Struktur Data', 'sks' => 3],
            ['kode_matakuliah' => 'IF53105', 'nama_matakuliah' => 'Jaringan Komputer', 'sks' => 2],
        ];
    }
}
