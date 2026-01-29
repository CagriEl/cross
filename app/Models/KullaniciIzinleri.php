<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KullaniciIzinleri extends Model
{
    use HasFactory;

    protected $table = 'kullanici_izinleri';

    protected $fillable = [
        'rol_adi',
        'cihaz_ekleme',
        'hastane_ekleme',
        'kart_ekleme',
        'sonuc_ekleme',
        'test_ekleme',
        'kullanici_ekleme',
    ];

    public function users()
    {
        return $this->hasMany(\App\Models\User::class, 'role_id');
    }
    
}
