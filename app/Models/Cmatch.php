<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cmatch extends Model
{
    protected $fillable = [
        'file_1',
        'file_1_name',
        'file_2',
        'file_2_name',
        'matched_records',
    ];

    protected $casts = [
        'matched_records' => 'array',
    ];
   public function matches()
{
    return $this->hasMany(\App\Models\HastaDonorMatch::class, 'cmatch_id');
}
}
