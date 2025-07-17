<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HastaDonor extends Model
{
    // ...

    // Filament tarafında Select::make('hasta_id')->relationship('hasta', 'ad') diyorsanız
    public function hasta(): BelongsTo
    {
        return $this->belongsTo(Hasta::class);
    }

    // Filament tarafında Select::make('donor_id')->relationship('donor', 'name') diyorsanız
    public function donor(): BelongsTo
    {
        return $this->belongsTo(Donor::class);
    }
}
