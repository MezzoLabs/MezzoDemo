<?php


namespace App\Magazine\Subscriptions;


use App\Magazine\Subscriptions\Http\SubscriptionTransformerPlugin;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Http\Transformers\TransformerRegistrar;

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
        $this->registerTransformerPlugin();
    }

    private function registerTransformerPlugin()
    {
        $transformers = TransformerRegistrar::make();

        $transformers->registerPlugin(new SubscriptionTransformerPlugin());
    }
}