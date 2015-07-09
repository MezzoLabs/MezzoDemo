<?php


namespace MezzoLabs\Mezzo\Core\ThirdParties;


use MezzoLabs\Mezzo\Core\ThirdParties\Wrappers;
use MezzoLabs\Mezzo\Core\ThirdParties\Wrappers\WrapperContract;

class Manager {

    /**
     * @var WrapperContract[]
     */
    protected $toWrap = [
        Wrappers\DingoApi::class
    ];

    public function registerWrappers(){
        foreach($this->toWrap as $wrapperClass){
            $wrapper = $this->createWrapper($wrapperClass);
            $wrapper->register();
        }
    }

    /**
     * @param $class
     * @return WrapperContract
     */
    public function createWrapper($class){
        $wrapper = app()->make($class);
        $className = get_class($wrapper);

        app()->instance('MezzoLabs\Mezzo\ThirdParties\\' . $className, $wrapper);

        return $wrapper;

    }

} 