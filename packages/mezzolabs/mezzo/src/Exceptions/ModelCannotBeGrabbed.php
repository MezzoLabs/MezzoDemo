<?php


namespace MezzoLabs\Mezzo\Exceptions;


use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;

class ModelCannotBeGrabbed extends \Exception{

    /**
     * @param string $Model
     * @param ModuleProvider $Module
     */
    public function  __construct($Model, ModuleProvider $Module){
        $this->message = "The model ". $Model . " cannot be grabbed by the module " . get_class($Module) .
            '. Maybe the reflector wasn`t able to find the model. It should be located inside the app directory.';
    }
} 