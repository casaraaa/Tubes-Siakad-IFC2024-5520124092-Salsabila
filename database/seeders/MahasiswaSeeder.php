<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->dataMahasiswa() as $baris) {
            Mahasiswa::create([
                'npm' => $baris['npm'],
                'nidn' => $baris['nidn'],
                'nama' => $baris['nama'],
            ]);

            User::create([
                'name' => $baris['nama'],
                'email' => $baris['email'],
                'password' => Hash::make('password'),
                'role' => User::ROLE_MAHASISWA,
                'npm' => $baris['npm'],
            ]);
        }
    }

    private function dataMahasiswa(): array
    {
        return [
            ['npm' => '5520124091', 'nidn' => '1001000001', 'nama' => 'Jaki Shim', 'email' => 'jaki@gmail.com'],
            ['npm' => '5520124076', 'nidn' => '1001000001', 'nama' => 'Farrel Fuzan Pohan', 'email' => 'farrel@gmail.com'],
            ['npm' => '5520124075', 'nidn' => '1001000002', 'nama' => 'Jay Park', 'email' => 'jay@gmail.com'],
            ['npm' => '5520124092', 'nidn' => '1001000004', 'nama' => 'Salsabila Rahmah Al-Fikriyah', 'email' => 'salsabila@gmail.com'],
        ];
    }
}
