<?php

namespace Database\Seeders;

use App\Models\Krs;
use Illuminate\Database\Seeder;

class KrsSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->dataKrs() as $baris) {
            Krs::create($baris);
        }
    }

    private function dataKrs(): array
    {
        return [
            ['npm' => '5520124091', 'kode_matakuliah' => 'IF53413'],
            ['npm' => '5520124075', 'kode_matakuliah' => 'IF53201'],
            ['npm' => '5520124076', 'kode_matakuliah' => 'IF53413'],
            ['npm' => '5520124092', 'kode_matakuliah' => 'IF53413'],
            ['npm' => '5520124092', 'kode_matakuliah' => 'IF53105'],
        ];
    }
}
