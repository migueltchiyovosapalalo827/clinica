<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //

        Gate::define('secretaria',function(User $user){
            return $user->tipo=='secretario(a)';
        });
        Gate::define('enfirmeiro',function(User $user){
            return $user->tipo=='enfirmeiro(a)';
        });

        Gate::define('admin',function(User $user){
            return $user->tipo=='Administrador';
        });

        Gate::define('medico',function(User $user){
            return $user->tipo=='Medico';
        });

        Gate::define('paciente',function(User $user){
            return $user->tipo=='paciente';
        });

        Gate::define('laboratorio',function(User $user){
            return $user->tipo=='tecnico de Laboratorio';
        });
    }
}
