<?php

namespace SIU\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use SIU\cumples;
use SIU\User;

class CumplePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function updatebarrio(User $user, cumples $cumple){

        return $user->idbarrio === $cumple->idbarrio;
    }


}
