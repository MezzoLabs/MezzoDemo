<?php


namespace App\Magazine\Newsletter;


use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;

class NewsletterModule extends ModuleProvider
{
    protected $models = [

    ];

    protected $options = [
        'icon' => 'ion-ios-paper'
    ];

    /**
     * Called when module is ready, model reflections are loaded.
     *
     * @return mixed
     */
    public function ready()
    {
        $this->loadViews();
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