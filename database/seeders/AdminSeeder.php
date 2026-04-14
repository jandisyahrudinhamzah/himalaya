<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // HAPUS USER LAMA DULU
        User::whereIn('email', ['admin@organisasi.com', 'bendahara@organisasi.com', 'anggota@organisasi.com'])->delete();
        
        // BUAT ADMIN
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@organisasi.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Bendahara',
            'email' => 'bendahara@organisasi.com',
            'password' => Hash::make('bendahara123'),
            'role' => 'bendahara',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Anggota Biasa',
            'email' => 'anggota@organisasi.com',
            'password' => Hash::make('anggota123'),
            'role' => 'anggota',
            'email_verified_at' => now(),
        ]);

        echo "✅ SEEDER SUKSES!\n";
        echo "Admin: admin@organisasi.com / admin123\n";
    }
}