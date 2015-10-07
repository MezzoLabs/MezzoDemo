<?php


namespace MezzoLabs\Mezzo\Exceptions;


use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;

class ModelIsAlreadyAssociated extends \Exception
{

    /**
     * @param ModelReflection $model
     * @param ModuleProvider $module
     */
    public function  __construct(ModelReflection $model, ModuleProvider $module)
    {
        $this->message = "The model " . $model->className() . ' is already associated with the module ' .
            $model->module()->qualifiedName() . '. Cannot associate with ' . $module->qualifiedName() . '. ';
    }
} 