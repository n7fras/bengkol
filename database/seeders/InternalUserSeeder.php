<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InternalUser; // Pastikan menggunakan model dengan PascalCase
use App\Models\Sales; // Pastikan menggunakan model dengan PascalCase
class InternalUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InternalUser::create([
            'username' => 'Super admin',
            'role' => 'Super Admin',
            'name' => 'Super Admin',
            'email' => 'z8lDy@example.com',
            'phone' => '08123456789',
            'address' => 'Jl. Contoh',
            'status' => true,
            'password' => bcrypt('password!@#'),
            'foto' => null
        ]);
    }
    
}

