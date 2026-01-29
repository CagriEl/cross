<?php

namespace App\Policies;

use App\Models\User;
use App\Models\KullaniciIzinleri;

class RolePolicy
{
    public function view(User $user, KullaniciIzinleri $role)
    {
        return $user->role_id === $role->id || $user->role->rol_adi === 'Admin';
    }

    public function update(User $user, KullaniciIzinleri $role)
    {
        return $user->role->rol_adi === 'Admin';
    }
}
