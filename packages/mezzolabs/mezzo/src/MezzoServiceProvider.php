<?php

namespace MezzoLabs\Mezzo;

use Illuminate\Support\ServiceProvider;
use MezzoLabs\Mezzo\Events\Core\MezzoHadBooted;

class MezzoServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot($app)
    {

        require __DIR__.'/../bootstrap/mezzo.php';

        event(new MezzoHadBooted(app('mezzo')));


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