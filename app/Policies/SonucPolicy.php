<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Sonuc;

class SonucPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasPermission('sonuc_ekleme');
    }

    public function create(User $user)
    {
        return $user->hasPermission('sonuc_ekleme');
    }

    public function update(User $user, Sonuc $sonuc)
    {
        return $user->hasPermission('sonuc_ekleme');
    }

    public function delete(User $user, Sonuc $sonuc)
    {
        return $user->hasPermission('sonuc_ekleme');
    }
}
