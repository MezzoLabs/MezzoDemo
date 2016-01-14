<?php


namespace App\Magazine\Subscriptions;


use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;

class SubscriptionsModule extends ModuleProvider
{
    protected $models = [
        \App\Subscription::class
    ];

    protected $options = [
        'visible' => false
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