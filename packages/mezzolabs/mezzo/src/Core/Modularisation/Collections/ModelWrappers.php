<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Collections;


use Illuminate\Database\Eloquent\Collection;
use MezzoLabs\Mezzo\Core\Modularisation\ModelWrapper;
use MezzoLabs\Mezzo\Exceptions\MezzoException;

class ModelWrappers extends Collection{

    public $items;

    /**
     * @param array[String] $classes
     */
    public function __construct(Array $classes){
        foreach($classes as $class){
            $this->add($class);
        }
    }

    /**
     * @param $model
     * @throws MezzoException
     * @return \MezzoLabs\Mezzo\Core\Modularisation\ModelWrapper
     */
    public static function makeWrapper($model){
        if(is_string($model)){
            return new ModelWrapper($model);
        }

        if(ModelWrapper::class == get_class($model))
            return $model;

        throw new MezzoException($model . ' is not a valid model.');
    }

    /**
     * @param mixed $model
     * @throws MezzoException
     * @internal param mixed $class
     * @return $this|void
     */
    public function add($model){
        $wrapper = $this->makeWrapper($model);
        $this->put($wrapper->className(), $wrapper);
    }

    /**
     * @param mixed $key
     * @return ModelWrapper
     */
    public function get($key){
        return parent::get($key);
    }

} 