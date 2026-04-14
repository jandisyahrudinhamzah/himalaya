<?php

// app/Models/Anggota.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggotas'; // Pastikan nama tabel sesuai
    
    protected $fillable = [
        'nama',
        'email',
        'nim',
        'no_hp',
        'jabatan',
        'status',
        'foto',
        'bio'
    ];

    // Scope untuk filter
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // Accessor untuk foto
    public function getFotoUrlAttribute()
    {
        return $this->foto ? asset('storage/' . $this->foto) : null;
    }
}