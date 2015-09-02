<?php


namespace MezzoLabs\Mezzo\Exceptions;


use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;

class ModelCannotBeGrabbed extends \Exception{

    /**
     * @param string $model
     * @param ModuleProvider $module
     */
    public function  __construct($model, ModuleProvider $module){
        $this->message = "The model ". $model . " cannot be grabbed by the module " . get_class($module) .
            '. The Reflector wasnt able to find the model. ' .
            'It should be located inside the app directory and use the Mezzo trait.';
    }
} 