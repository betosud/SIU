<?php

namespace SIU\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use SIU\lideres;
use SIU\User;

class LiderPolicy
{
    use HandlesAuthorization;

    public function update(User $user, lideres $lider){

        return $user->idbarrio === $lider->idbarrio;
    }
}
