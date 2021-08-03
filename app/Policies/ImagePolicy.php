<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Image;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImagePolicy
{
    use HandlesAuthorization;

    public function index(User $u)
    {
        return $u->hasPermission('images-index');
    }

    public function create(User $u)
    {
        return $u->hasPermission('images-create');
    }

    public function update(User $u, Image $i)
    {
        $i->load('product');

        return $u->hasPermission('images-update') &&
            $i->author_id == $u->id;
    }

    public function delete(User $u, Image $i)
    {
        $i->load('product');

        return $u->hasPermission('images-delete') &&
            $i->author_id == $u->id;
    }
}
