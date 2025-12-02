<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LissResult extends Model
{
    use HasFactory;

    protected $table = 'liss_results';

    protected $fillable = [
        'kart_id',
        'sonuc_siparis_no',
        'test_id_raw',
        'cardlis_id',
        'test_name',
        'sonuc_ham',
        'normallik',
        'sonuc_tipi',
        'operator',
        'test_baslama',
        'test_bitis',
        'device_name',
        'device_serial',
        'device_software_version',
        'pic_name',
        'pic_length',
        'pic_info',
        'raw_line',
    ];

    public function kart()
    {
        return $this->belongsTo(Kart::class);
    }
}
