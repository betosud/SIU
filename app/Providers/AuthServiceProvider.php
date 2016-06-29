<?php

namespace SIU\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use SIU\Task;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'SIU\Model' => 'SIU\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('leer-asignacion-barrio',function ($user,$asignacion){
            return $user->idbarrio === $asignacion->idbarrio;
        });

        $gate->define('leer-asignacion-usuario',function ($user,$asignacion){
            return $user->id === $asignacion->user_id;
        });
    }
}
