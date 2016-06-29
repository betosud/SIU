<?php

namespace SIU\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use SIU\sit;
use SIU\User;

class SitPolicy
{
    use HandlesAuthorization;

    public function updatebarrio(User $user, sit $sit){

        return $user->idbarrio === $sit->idbarrio;
    }

    public function updatetokesit(sit $sit,$token){

        return $sit->token === $token;
    }

    public function status(sit $sit,$token){

        return $token === $sit->token;
    }
}
