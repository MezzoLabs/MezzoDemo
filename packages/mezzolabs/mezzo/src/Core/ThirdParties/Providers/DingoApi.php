<?php


namespace MezzoLabs\Mezzo\Core\ThirdParties\Providers;


use Dingo\Api\Provider\LaravelServiceProvider as DingoProvider;

class DingoApi implements ThirdPartyContract{

    public function register()
    {
        app()->register(DingoProvider::class);
    }
}