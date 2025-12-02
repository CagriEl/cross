<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasta extends Model
{
    use HasFactory;

    // Eğer tablo ismin özel değilse bunu yazmana gerek yok,
    // ama tablo adın 'hastas' dışında bir şeyse burada belirtmelisin:
    // protected $table = 'hastalar';

    protected $fillable = [
        'ad',
        'soyad',
        'kan_grubu',
        'aciliyet_derecesi',
        'kayit_tipi',   // 🔴 BUNUN MUTLAKA OLMASI LAZIM
        'hastane_id',
    ];

    public function hastane()
    {
        return $this->belongsTo(Hastane::class);
    }
}
