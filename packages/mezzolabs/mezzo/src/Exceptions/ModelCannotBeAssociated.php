<?php


namespace MezzoLabs\Mezzo\Exceptions;


use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflections;

class ModelCannotBeAssociated extends \Exception{

    /**
     * @param string $model
     * @param ModuleProvider $module
     */
    public function  __construct($model, ModuleProvider $module){
        if(get_class($model) == ModelReflection::class) $model = $model->className();

        $this->message = "The model ". $model . " cannot be grabbed by the module " . get_class($module) .
            '. The Reflector wasnt able to find the model. ' .
            'It should be located inside the app directory and use the Mezzo trait.';

        $this->message .= "Here is a list of all possible models: \n";

        foreach(mezzo()->moduleCenter()->reflector()->reflections() as $reflection){
            $this->message .= $reflection->className() . "\n";
        }
    }
} 