<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $table = 'testler';

    protected $fillable = [
        'test_adi',
    ];

    public function karts()
    {
        return $this->hasMany(Kart::class);
    }
}
