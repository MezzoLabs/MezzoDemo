<?php


namespace MezzoLabs\Mezzo\Core\ThirdParties\Wrappers;


use Dingo\Api\Provider\LaravelServiceProvider as DingoProvider;
use Dingo\Api\Routing\Router;

class DingoApi extends GenericWrapper{

    /**
     * The Dingo Api router
     *
     * @var Router
     */
    private $api;

    /**
     * Class string of the packages laravel provider.
     *
     * @var string
     */
    protected $provider = DingoProvider::class;

    /**
     * Prepare the configuration before a new service gets registered
     *
     * @return mixed
     */
    public function prepareConfig()
    {
        $this->mezzoConfig->overwrite('api', 'mezzo.api');
    }

    /**
     * Called when the package service provider got booted. (We listened carefully)
     *
     * @return mixed
     */
    public function onProviderBooted()
    {
        if($this->booted) return false;
        parent::onProviderBooted();

        $this->api = $this->mezzo->make(Router::class);
    }

    /**
     * @return Router
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * Get the instance of this wrapper which is stored inside the thirdParties collection.
     *
     * @return DingoApi
     */
    public static function make(){
        return mezzo()->make('mezzo.thirdParties')->get('DingoApi');
    }

}