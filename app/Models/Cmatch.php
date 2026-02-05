<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cmatch extends Model
{
    protected $guarded = [];

    public function hasta()
    {
        return $this->belongsTo(Hasta::class, 'hasta_id');
    }

    public function donor()
    {
        return $this->belongsTo(Donor::class, 'donor_id');
    }
}