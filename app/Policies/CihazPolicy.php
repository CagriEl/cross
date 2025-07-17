<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Cihaz;

class CihazPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasPermission('cihaz_ekleme');
    }

    public function create(User $user)
    {
        return $user->hasPermission('cihaz_ekleme');
    }

    public function update(User $user, Cihaz $cihaz)
    {
        return $user->hasPermission('cihaz_ekleme');
    }

    public function delete(User $user, Cihaz $cihaz)
    {
        return $user->hasPermission('cihaz_ekleme');
    }
}
