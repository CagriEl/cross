<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasta extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad',
        'soyad',
        'kan_grubu',
        'aciliyet_derecesi',
        'kayit_tipi',
        'hastane_id',
    ];

    public function hastane()
    {
        return $this->belongsTo(Hastane::class);
    }

    // Hasta ile eşleşen kayıtları görmek istersen:
    public function matches()
    {
        return $this->hasMany(Cmatch::class, 'hasta_id');
    }

    protected static function booted()
    {
        static::created(function ($hasta) {
            // Kayıt anında eşleşme servisini tetikle
            (new \App\Services\MatchingService())->checkForHasta($hasta);
        });
    }
}