<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->dataJadwal() as $baris) {
            Jadwal::create($baris);
        }
    }

    private function dataJadwal(): array
    {
        return [
            ['kode_matakuliah' => 'IF53413', 'nidn' => '1001000001', 'kelas' => 'A', 'hari' => 'Senin', 'jam' => '08:00'],
            ['kode_matakuliah' => 'IF53201', 'nidn' => '1001000002', 'kelas' => 'A', 'hari' => 'Selasa', 'jam' => '10:00'],
            ['kode_matakuliah' => 'IF53310', 'nidn' => '1001000003', 'kelas' => 'B', 'hari' => 'Rabu', 'jam' => '13:00'],
            ['kode_matakuliah' => 'IF53105', 'nidn' => '1001000004', 'kelas' => 'A', 'hari' => 'Kamis', 'jam' => '09:00'],
        ];
    }
}
