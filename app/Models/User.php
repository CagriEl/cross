<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'phone', 'role_id', 'hastane_id'];

    /**
     * Role ilişkisi
     */
    public function role()
    {
        return $this->belongsTo(\App\Models\KullaniciIzinleri::class, 'role_id');
    }

    /**
     * Hastane ilişkisi
     */
    public function hastane()
    {
        return $this->belongsTo(Hastane::class, 'hastane_id');
    }

    /**
     * Kullanıcının bir izne sahip olup olmadığını kontrol eder
     */
    public function hasPermission($permission): bool
{
    if (!$this->role) {
        return false; // Kullanıcının rolü yoksa yetkisi de yok
    }

    return (bool) $this->role?->$permission;
}



    /**
     * Kullanıcının Admin olup olmadığını kontrol eder
     */
    public function isAdmin(): bool
    {
        return $this->role?->rol_adi === 'Admin';
    }

    protected static function boot()
{
    parent::boot();

    static::creating(function ($user) {
        if (!$user->role_id) {
            // Varsayılan rol "Teknisyen" olsun
            $defaultRole = \App\Models\KullaniciIzinleri::where('rol_adi', 'Teknisyen')->first();
            $user->role_id = $defaultRole?->id;
        }
    });
}
}
