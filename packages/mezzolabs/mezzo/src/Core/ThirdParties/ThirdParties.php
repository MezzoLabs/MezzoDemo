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
     * A Collection of the wrappers
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
     * @var string[]
     */
    protected $toLoad = [
        "DingoApi" => Wrappers\DingoApi::class
    ];

    /**
     * Create the wrapper classes and put them into the collection
     */
    public function createWrappers(){
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
    protected function prepareConfigs(){
        $this->map(function(WrapperInterface $wrapper){
            $wrapper->prepareConfig();
        });
    }

    public function beforeProvidersBoot(){
        echo "before providers boot";
        $this->prepareConfigs();
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