<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kart extends Model
{
    use HasFactory;

    protected $table = 'kartlar';

    protected $fillable = [
        'kart_numarasi',
        'test_id',   // ÖNEMLİ: tip yerine artık test_id kullanıyoruz
    ];

    /**
     * Kart → Test (bir kart bir teste bağlı)
     */
    public function test()
    {
        // ÖNEMLİ: mutlaka return olmalı
        return $this->belongsTo(Test::class);
    }

    /**
     * Kart → Sonuçlar
     */
    public function sonuclar()
    {
        return $this->hasMany(Sonuc::class);
    }
    public function lissResults()
{
    return $this->hasMany(\App\Models\LissResult::class);
}

}
