<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Bendahara',
            'email' => 'bendahara@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'bendahara'
        ]);

        User::create([
            'name' => 'Anggota',
            'email' => 'anggota@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'anggota'
        ]);
    }
}