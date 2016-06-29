<?php

namespace SIU\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use SIU\asignaciones;
use SIU\User;

class AsignacionPolicy
{
    use HandlesAuthorization;

    public function updatebarrio(User $user, asignaciones $asignacion){

        return $user->idbarrio === $asignacion->idbarrio;
    }

    public function updateuser(User $user, asignaciones $asignacion){

        return $user->id === $asignacion->user_id;
    }

}
