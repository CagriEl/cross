<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cihaz extends Model
{
    use HasFactory;
    protected $table = 'cihazlar';

    protected $fillable = ['cihaz_adi', 'hastane_id'];

    public function hastane()
    {
        return $this->belongsTo(Hastane::class);
    }
    public function testler()
{
    return $this->hasMany(Test::class, 'cihaz_id');
}
}

