<?php

namespace SIU\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use SIU\bautizmal;
use SIU\User;

class BautizmalesPolicy
{
    use HandlesAuthorization;

    public function updatebarriobautizmal(User $user, bautizmal $bautizmal){

        return $user->idbarrio === $bautizmal->idbarrio;
    }

    public function updateuser(User $user, bautizmal $bautizmal){

        return $user->id === $bautizmal->user_id;
    }
}
