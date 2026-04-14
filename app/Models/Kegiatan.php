<?php
// app/Models/Kegiatan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'lokasi',
        'kuota',
        'status',
        'foto'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'kuota' => 'integer'
    ];

    // Accessor untuk foto URL
    public function getFotoUrlAttribute()
    {
        return $this->foto ? asset('storage/' . $this->foto) : null;
    }
}