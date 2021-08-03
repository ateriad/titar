<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Video;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    public function index(User $u)
    {
        return $u->hasPermission('videos-index');
    }

    public function create(User $u)
    {
        return $u->hasPermission('videos-create');
    }

    public function update(User $u, Video $v)
    {
        $v->load('product');

        return $u->hasPermission('videos-update') &&
            $v->author_id == $u->id;
    }

    public function delete(User $u, Video $v)
    {
        $v->load('product');

        return $u->hasPermission('videos-delete') &&
            $v->author_id == $u->id;
    }
}
