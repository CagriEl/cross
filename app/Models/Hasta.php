<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hastane;

class Hasta extends Model
{
    use HasFactory;

    protected $fillable = ['ad', 'soyad', 'kan_grubu', 'hastane_id', 'aciliyet_derecesi'];

    // 🟢 Hastanın kan grubuna göre uygun donörler
    public function uygunDonorler()
    {
        return $this->hasMany(Donor::class, 'kan_grubu', 'kan_grubu')
                    ->whereDate('son_kullanma_tarihi', '>=', now());
    }

    // 🟢 HASTANE ilişkisi (bunu EKLE)
    public function hastane()
    {
        return $this->belongsTo(Hastane::class, 'hastane_id');
    }
}
