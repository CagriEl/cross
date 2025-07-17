<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $table = 'testler';

    protected $fillable = ['test_adi', 'cihaz_adi'];

    public function sonuclar()
    {
        return $this->hasMany(Sonuc::class);
    }

    public function cihaz()
    {
        return $this->belongsTo(Cihaz::class, 'cihaz_id');
    }
}
