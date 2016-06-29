<?php

namespace SIU\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use SIU\discursos;
use SIU\User;

class DiscursoPolicy
{
    use HandlesAuthorization;

    public function updatebarrio(User $user, discursos $discursos){

        return $user->idbarrio === $discursos->idbarrio;
    }

    public function updateuser(User $user, discursos $discursos){

        return $user->id === $discursos->user_id;
    }
}
