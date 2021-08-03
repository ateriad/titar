<?php


namespace App\Policies;


use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    public function index(User $u)
    {
        return $u->hasPermission('events-index');
    }

    public function create(User $u)
    {
        return $u->hasPermission('events-create');
    }

    public function update(User $u, Event $v)
    {
        $v->load('product');

        return $u->hasPermission('events-update') &&
            $v->author_id == $u->id;
    }

    public function delete(User $u, Event $v)
    {
        $v->load('product');

        return $u->hasPermission('events-delete') &&
            $v->author_id == $u->id;
    }
}
