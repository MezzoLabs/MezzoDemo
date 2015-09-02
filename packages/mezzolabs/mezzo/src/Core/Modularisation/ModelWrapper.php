<?php


namespace MezzoLabs\Mezzo\Core\Modularisation;


class ModelWrapper {
    /**
     * @var string Name of the eloquent class that is wrapped
     */
    private $className;

    /**
     * @param $className
     */
    public function __construct($className){

        $this->className = $className;
    }

    /**
     * @return string
     */
    public function className(){
        return $this->className;
    }
} 