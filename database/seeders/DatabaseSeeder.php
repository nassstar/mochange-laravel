<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat 1 akun Admin
        User::create([
            'name' => 'Admin MOCHANGE',
            'email' => 'admin@mochange.com',
            'password' => Hash::make('admin123'), // Password otomatis dienkripsi anti-hacker!
        ]);
    }
}
