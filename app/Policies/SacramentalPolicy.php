<?php

namespace SIU\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use SIU\sacramentales;
use SIU\User;

class SacramentalPolicy
{
    use HandlesAuthorization;

    public function updatebarrio(User $user, sacramentales $sacramental){

        return $user->idbarrio === $sacramental->idbarrio;
    }

    public function updateuser(User $user, sacramentales $sacramental){

        return $user->id === $sacramental->user_id;
    }
}
