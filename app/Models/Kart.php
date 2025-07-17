<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kart extends Model
{
    use HasFactory;
    protected $table = 'kartlar';

    protected $fillable = ['kart_numarasi', 'tip'];

    public function sonuclar()
    {
        return $this->hasMany(Sonuc::class);
    }
}
