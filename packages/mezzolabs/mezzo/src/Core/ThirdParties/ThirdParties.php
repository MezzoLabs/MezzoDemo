<?php


namespace MezzoLabs\Mezzo\Core\ThirdParties;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\ThirdParties\Wrappers;
use MezzoLabs\Mezzo\Core\ThirdParties\Wrappers\WrapperInterface;
use PhpSpec\Wrapper\Wrapper;

class ThirdParties extends Collection
{
    /**
     * @var string[]
     */
    protected $toLoad = [
        "DingoApi" => Wrappers\DingoApi::class
    ];

    /**
     * A Collection of the reflections
     *
     * @var WrapperInterface[]
     */
    protected $items = [];

    /**
     * @var Mezzo
     */
    private $mezzo;

    public function __construct(array $items = [])
    {
        parent::__construct($items);

        $this->mezzo = mezzo();
    }

    /**
     * Create the wrapper classes and put them into the collection
     */
    public function createWrappers()
    {
        foreach ($this->toLoad as $wrapperKey => $wrapperClass) {
            $wrapper = $this->createWrapper($wrapperClass);
            $this->put($wrapperKey, $wrapper);
        }

    }

    /**
     * Register the wrapped package service providers
     */
    public function registerWrappers()
    {
        $this->map(function(WrapperInterface $wrapper){
            $wrapper->register();
        });
    }

    /**
     * Prepare the configurations for each third party package before they boot.
     */
    public function prepareConfigs(){
        $this->map(function(WrapperInterface $wrapper){
            $wrapper->prepareConfig();
        });
    }

    /**
     * Called when all the providers are booted and ready to take the request
     */
    public function onProvidersBooted(){
        $this->map(function(WrapperInterface $wrapper){
            $wrapper->onProviderBooted();
        });
    }

    /**
     * @param $class
     * @return WrapperInterface
     */
    protected function createWrapper($class)
    {
        $wrapper = $this->mezzo->make($class);
        $className = get_class($wrapper);

        $this->mezzo->app()->instance('MezzoLabs\Mezzo\ThirdParties\\' . $className, $wrapper);

        return $wrapper;

    }

} 