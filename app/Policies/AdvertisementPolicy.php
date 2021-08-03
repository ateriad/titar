<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdvertisementPolicy
{
    use HandlesAuthorization;

    public function index(User $u)
    {
        return $u->hasPermission('advertisements-index');
    }

    public function create(User $u)
    {
        return $u->hasPermission('advertisements-create');
    }

    public function update(User $u)
    {

        return $u->hasPermission('advertisements-update');
    }

    public function delete(User $u)
    {
        return $u->hasPermission('advertisements-delete');
    }
}
