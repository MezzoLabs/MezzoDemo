<?php


namespace MezzoLabs\Mezzo\Core\ThirdParties\Wrappers;


use Dingo\Api\Provider\LaravelServiceProvider as DingoProvider;

class DingoApi implements WrapperContract{

    public function register()
    {
        app()->register(DingoProvider::class);
    }

    /**
     * Prepare the configuration before a new service gets registered
     *
     * @return mixed
     */
    public function prepareConfig()
    {
        // TODO: Implement prepareConfig() method.
    }
}