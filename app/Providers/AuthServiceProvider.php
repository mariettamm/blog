<?php

namespace App\Providers;

//damos de alta la entidad post y la política de seguridad
use App\Post;
use App\Policies\PostPolicy;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy', //esto de aquí realmente no hace nada
        //especificamos en este array que la entidad post
        //está RELACIONADA (=>) con la política que hemos creado
        Post::class => PostPolicy::class
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
    }
}
