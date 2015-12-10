<?php


namespace App\Magazine\Shop;


use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;

class ShopModule extends ModuleProvider
{

    protected $options = [
        'icon' => 'ion-ios-cart'
    ];

    /**
     * Called when module is ready, model reflections are loaded.
     *
     * @return mixed
     */
    public function ready()
    {
        // TODO: Implement ready() method.
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // TODO: Implement register() method.
    }
}