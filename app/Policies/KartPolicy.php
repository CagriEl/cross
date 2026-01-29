<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Kart;

class KartPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasPermission('kart_ekleme');
    }

    public function create(User $user)
    {
        return $user->hasPermission('kart_ekleme');
    }

    public function update(User $user, Kart $kart)
    {
        return $user->hasPermission('kart_ekleme');
    }

    public function delete(User $user, Kart $kart)
    {
        return $user->hasPermission('kart_ekleme');
    }
}
