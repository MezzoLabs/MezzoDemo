<?php


namespace MezzoLabs\Mezzo\Core\ThirdParties;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\ThirdParties\Wrappers;
use MezzoLabs\Mezzo\Core\ThirdParties\Wrappers\WrapperInterface;

class Manager extends Collection
{
    /**
     * A Collection of the wrappers
     *
     * @var array
     */
    protected $items = [];

    /**
     * @var Mezzo
     */
    private $mezzo;

    public function __construct(Mezzo $mezzo)
    {
        $this->mezzo = $mezzo;
    }

    /**
     * @var string[]
     */
    protected $toLoad = [
        "DingoApi" => Wrappers\DingoApi::class
    ];

    public function registerWrappers()
    {
        foreach ($this->toLoad as $wrapperClass) {
            $wrapper = $this->createWrapper($wrapperClass);
            $wrapper->register();
        }
    }

    public function createWrappers(){
        foreach ($this->toLoad as $wrapperKey => $wrapperClass) {
            $wrapper = $this->createWrapper($wrapperClass);
            $this->put($wrapperKey, $wrapper);
        }
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