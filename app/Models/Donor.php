<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Donor extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad', 
        'soyad', 
        'kan_grubu', 
        'son_kullanma_tarihi', 
        'transfer_edildi'
    ];

    protected $casts = [
        'transfer_edildi' => 'boolean',
        'son_kullanma_tarihi' => 'date',
    ];

    public function getKalanGunAttribute()
    {
        if (!$this->son_kullanma_tarihi) return 0;
        return Carbon::parse($this->son_kullanma_tarihi)->diffInDays(now(), false);
    }

    // Donör ile eşleşen kayıtları görmek istersen:
    public function matches()
    {
        return $this->hasMany(Cmatch::class, 'donor_id');
    }

    protected static function booted()
    {
        static::created(function ($donor) {
            // Kayıt anında eşleşme servisini tetikle
            (new \App\Services\MatchingService())->checkForDonor($donor);
        });
    }
}