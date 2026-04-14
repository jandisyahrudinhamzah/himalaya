<?php

// app/Models/Artikel.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $fillable = ['judul', 'konten', 'gambar', 'slug', 'status', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
