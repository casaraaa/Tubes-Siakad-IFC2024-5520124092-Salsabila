<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->dataDosen() as $baris) {
            Dosen::create($baris);
        }
    }

    private function dataDosen(): array
    {
        return [
            ['nidn' => '1001000001', 'nama' => 'Dr. Budi Santoso, M.Kom'],
            ['nidn' => '1001000002', 'nama' => 'Siti Aminah, M.T.'],
            ['nidn' => '1001000003', 'nama' => 'Ahmad Fauzi, M.Cs.'],
            ['nidn' => '1001000004', 'nama' => 'Lalan Jaelani'],
        ];
    }
}
