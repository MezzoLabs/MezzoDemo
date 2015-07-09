<?php

namespace MezzoLabs\Mezzo;

use Illuminate\Support\ServiceProvider;
use MezzoLabs\Mezzo\Core\ThirdParties\Manager;
use MezzoLabs\Mezzo\Events\Core\MezzoBooted;
use MezzoLabs\Mezzo\Providers\EventServiceProvider;

class MezzoServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        require __DIR__.'/../bootstrap/mezzo.php';

        event(new MezzoBooted(app('mezzo')));
    }


    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        app()->register(EventServiceProvider::class);
        $this->registerThirdParties();
    }

    protected function registerThirdParties(){
        $thirdPartyManager = new Manager();
        $thirdPartyManager->registerWrappers();
    }
}