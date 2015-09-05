<?php


namespace MezzoLabs\Mezzo\Exceptions;


use MezzoLabs\Mezzo\Core\Modularisation\ModelWrapper;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Modules\SampleModule\Module;

class NotAValidModel extends \Exception{

    /**
     * You can only make a modelWrapper out of a class name (string) or out of an existing modelWrapper
     *
     * @param string $notAModel
     * @internal param ModelWrapper $model
     * @internal param ModuleProvider $module
     */
    public function  __construct($notAModel){
        $this->message = get_class($notAModel) . ' is not a model.';
    }
} 