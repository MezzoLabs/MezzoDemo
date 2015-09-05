<?php


namespace MezzoLabs\Mezzo\Exceptions;


use MezzoLabs\Mezzo\Core\Modularisation\ModelWrapping\ModelWrapper;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Modules\SampleModule\Module;

class ModelIsAlreadyAssociated extends \Exception{

    /**
     * @param ModelWrapper $model
     * @param ModuleProvider $module
     */
    public function  __construct(ModelWrapper $model, ModuleProvider $module){
        $this->message = "The model " . $model->className() . ' is already associated with the module ' .
            $model->module()->identifier() . '. Cannot associate with ' . $module->identifier() . '. ';
    }
} 