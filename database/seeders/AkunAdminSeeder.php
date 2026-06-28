<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AkunAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@siakad.test',
            'password' => Hash::make('password'),
            'role' => User::ROLE_ADMIN,
        ]);
    }
}
