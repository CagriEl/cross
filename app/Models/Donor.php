<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Donor extends Model
{
    use HasFactory;

    protected $fillable = ['ad', 'soyad', 'kan_grubu', 'son_kullanma_tarihi', 'transfer_edildi'];

    protected $casts = [
        'transfer_edildi' => 'boolean',
    ];

    // 🟢 Donörün kalan gün sayısını hesaplayalım
    public function getKalanGunAttribute()
    {
        return Carbon::parse($this->son_kullanma_tarihi)->diffInDays(now());
    }
    public function hasta(): BelongsTo
    {
        return $this->belongsTo(Hasta::class);
    }

    public function donor(): BelongsTo
    {
        return $this->belongsTo(Donor::class);
    }
}
