<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Collections;


use Illuminate\Database\Eloquent\Collection;
use MezzoLabs\Mezzo\Core\Modularisation\ModelWrapper;

class ModelWrappers extends Collection{

    public $items;

    /**
     * @param array[String] $classes
     */
    public function __construct(Array $classes){
        foreach($classes as $class){
            $this->createWrapper($class);
        }
    }

    /**
     * @param $class
     */
    public function createWrapper($class){
        $wrapper = new ModelWrapper($class);
        $this->add($class, $wrapper);
    }
} 