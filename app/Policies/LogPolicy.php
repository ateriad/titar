<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LogPolicy
{
    use HandlesAuthorization;

    public function index(User $u)
    {
        return $u->hasPermission('logs-index');
    }
}
