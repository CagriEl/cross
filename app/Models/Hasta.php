<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasta extends Model
{
    use HasFactory;

    protected $fillable = ['ad', 'soyad', 'kan_grubu', 'hastane_id', 'aciliyet_derecesi'];

    // 🟢 Hastanın kan grubuna göre uygun donörleri getir
    public function uygunDonorler()
    {
        return $this->hasMany(Donor::class, 'kan_grubu', 'kan_grubu')
                    ->whereDate('son_kullanma_tarihi', '>=', now()); // Son kullanma tarihi geçmemiş donörleri getir
    }
}
