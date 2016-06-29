<?php

namespace SIU\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use SIU\User;
use SIU\archivossit;

class ArchivoSitPolicy
{
    use HandlesAuthorization;

    public function updatebarrioarchivo(User $user, archivossit $archivosit){

        return $user->idbarrio === $archivosit->datossit->idbarrio;
    }

}
