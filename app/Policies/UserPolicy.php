<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Kullanıcı listeleme yetkisi
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('kullanici_ekleme');
    }

    /**
     * Yeni kullanıcı ekleme yetkisi
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('kullanici_ekleme');
    }

    /**
     * Kullanıcı düzenleme yetkisi
     */
    public function update(User $user): bool
    {
        return $user->hasPermission('kullanici_ekleme');
    }

    /**
     * Kullanıcı silme yetkisi
     */
    public function delete(User $user): bool
    {
        return $user->hasPermission('kullanici_ekleme');
    }
}
