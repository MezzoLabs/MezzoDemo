<?php

namespace App\Magazine\Advertisements;


use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;

class AdvertisementsModule extends ModuleProvider
{
    protected $options = [
        'icon' => 'fa fa-bullhorn'
    ];


    /**
     * Called when module is ready, model reflections are loaded.
     *
     * @return mixed
     */
    public function ready()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }
}