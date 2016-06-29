<?php

namespace SIU\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use SIU\entrevistas;
use SIU\User;

class EntrevistaPolicy
{
    use HandlesAuthorization;

    public function updatebarrio(User $user, entrevistas $entrevistas){

        return $user->idbarrio === $entrevistas->idbarrio;
    }

    public function updateuser(User $user, asignaciones $asignacion){

        return $user->id === $asignacion->user_id;
    }
}
