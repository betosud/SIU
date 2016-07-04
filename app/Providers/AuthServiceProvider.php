<?php

namespace SIU\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'SIU\Model' => 'SIU\Policies\ModelPolicy',
        'SIU\lideres' => 'SIU\Policies\LiderPolicy',
        'SIU\asignaciones' => 'SIU\Policies\AsignacionPolicy',
        'SIU\entrevistas' => 'SIU\Policies\EntrevistaPolicy',
        'SIU\discursos' => 'SIU\Policies\DiscursoPolicy',
        'SIU\sit' => 'SIU\Policies\SitPolicy',
        'SIU\archivossit' => 'SIU\Policies\ArchivoSitPolicy',
        'SIU\bautizmal' => 'SIU\Policies\BautizmalesPolicy',
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

        //
    }
}
