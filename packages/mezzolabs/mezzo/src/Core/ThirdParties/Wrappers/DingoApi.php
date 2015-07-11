<?php


namespace MezzoLabs\Mezzo\Core\ThirdParties\Wrappers;


use Dingo\Api\Provider\LaravelServiceProvider as DingoProvider;

class DingoApi extends GenericWrapper implements WrapperInterface{

    protected $provider = DingoProvider::class;

    /**
     * Prepare the configuration before a new service gets registered
     *
     * @return mixed
     */
    public function prepareConfig()
    {

    }
}