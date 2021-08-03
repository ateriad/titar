<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function index(User $u)
    {
        return $u->hasPermission('users-index');
    }

    public function create(User $u)
    {
        return $u->hasPermission('users-create');
    }

    public function update(User $u)
    {
        return $u->hasPermission('users-update');
    }

    public function delete(User $u)
    {
        return $u->hasPermission('users-delete');
    }
}
