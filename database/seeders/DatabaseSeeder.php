<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Artikel;
use App\Models\Kegiatan;
use App\Models\Anggota;
use App\Models\Galeri;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        // USER ADMIN
        $admin = User::create([
            'name' => 'Admin HIMAYALA',
            'email' => 'admin@himayala.ac.id',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // ARTIKEL
        Artikel::create([
            'judul' => 'Kegiatan Pertama HIMAYALA',
            'slug' => 'kegiatan-pertama-himayala',
            'konten' => 'Deskripsi artikel...',
            'status' => 'published',
            'user_id' => $admin->id
        ]);

        // KEGIATAN
        Kegiatan::create([
            'judul' => 'Kunjungan Studi',
            'tanggal' => now()->addDays(7),
            'lokasi' => 'Universitas Yaman',
            'status' => 'Upcoming',
            'deskripsi' => 'Deskripsi kegiatan...',
        ]);

        // ANGGOTA
        Anggota::create([
    'nama' => 'Mahasiswa 1',
    'email' => 'mahasiswa1@himayala.ac.id',
    'nim' => '12345678',
    'jabatan' => 'Ketua',
    'status' => 'aktif',
]);

        // GALERI
        Galeri::create([
            'foto' => 'path/to/image.jpg',
            'kategori' => 'kegiatan',
        ]);

    }
}