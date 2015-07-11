<?php

namespace MezzoLabs\Mezzo;

use Illuminate\Support\ServiceProvider;
use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\ThirdParties\Manager;
use MezzoLabs\Mezzo\Events\Core\MezzoBooted;
use MezzoLabs\Mezzo\Providers\EventServiceProvider;

class MezzoServiceProvider extends ServiceProvider
{

    /**
     * The Mezzo core.
     *
     * @var Mezzo
     */
    protected $mezzo;


    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mezzo->onProviderBooted();

    }


    /**
     * Register any package services.
     *
     * We have to boot Mezzo here because we will include third party providers during the boot process.
     * Before they start we want to add some additional settings.
     *
     * @return void
     */
    public function register()
    {
        $this->mezzo = require __DIR__.'/../bootstrap/mezzo.php';

        $this->mezzo->onProviderRegistered();


    }

}