<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hastane extends Model
{
    use HasFactory;

    protected $fillable = ['hastane_adi', 'hastane_adres'];
    protected $table = 'hastaneler';

    public function cihazlar()
    {
        return $this->hasMany(Cihaz::class);
    }
    
    public function users()
    {
        return $this->hasMany(User::class, 'hastane_id');
    }
}




