<?php
// app/Models/Hasta.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hasta extends Model
{
    // ...

    public function donors(): HasMany
    {
        return $this->hasMany(HastaDonor::class);
    }
}
