<?php

namespace MezzoLabs\Mezzo;

use Illuminate\Support\ServiceProvider;

class MezzoServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        dd(new \Dingo\Api\Provider\LaravelServiceProvider());

        if (! $this->app->routesAreCached()) {
            require __DIR__.'/Http/routes.php';
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}