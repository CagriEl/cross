<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Test;

class TestPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasPermission('test_ekleme');
    }

    public function create(User $user)
    {
        return $user->hasPermission('test_ekleme');
    }

    public function update(User $user, Test $test)
    {
        return $user->hasPermission('test_ekleme');
    }

    public function delete(User $user, Test $test)
    {
        return $user->hasPermission('test_ekleme');
    }
}
