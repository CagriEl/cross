<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sonuc extends Model
{
    use HasFactory;
    protected $table = 'sonuclar';


    protected $fillable = ['kart_id', 'test_id', 'sonuc'];

    public function kart()
    {
        return $this->belongsTo(Kart::class);
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}

