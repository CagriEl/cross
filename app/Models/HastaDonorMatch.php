<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class HastaDonorMatch extends Model
{
    use HasFactory;

    protected $fillable = ['hasta_id', 'donor_id'];

    // 🟢 Hastayı Getir
   public function hasta(): BelongsTo
{
    return $this->belongsTo(Hasta::class);
}

public function donor(): BelongsTo
{
    return $this->belongsTo(Donor::class);
}


    // 🟢 Donörün kalan gün sayısını hesapla
    public function getKalanGunAttribute()
    {
        return $this->donor ? Carbon::parse($this->donor->son_kullanma_tarihi)->diffInDays(now()) : '-';
    }

     public function cmatch()
    {
        return $this->belongsTo(\App\Models\Cmatch::class, 'cmatch_id');
    }
}
