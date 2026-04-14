<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the activities for the admin.
     */
    public function activities()
    {
        return $this->hasMany(Kegiatan::class);
    }

    /**
     * Get the articles created by the admin.
     */
    public function articles()
    {
        return $this->hasMany(Artikel::class);
    }

    /**
     * Check if admin is active.
     */
    public function isActive(): bool
    {
        return true; // Bisa ditambahkan field 'is_active' jika perlu
    }
}