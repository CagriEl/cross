<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Hastane;

class HastanePolicy
{
    public function viewAny(User $user)
    {
        return $user->hasPermission('hastane_ekleme');
    }

    public function create(User $user)
    {
        return $user->hasPermission('hastane_ekleme');
    }

    public function update(User $user, Hastane $hastane)
    {
        return $user->hasPermission('hastane_ekleme');
    }

    public function delete(User $user, Hastane $hastane)
    {
        return $user->hasPermission('hastane_ekleme');
    }
}
