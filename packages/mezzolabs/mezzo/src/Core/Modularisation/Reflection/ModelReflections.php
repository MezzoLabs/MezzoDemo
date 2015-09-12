<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Reflection;


use Illuminate\Database\Eloquent\Collection;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;
use MezzoLabs\Mezzo\Exceptions\MezzoException;
use MezzoLabs\Mezzo\Exceptions\NotAValidModel;

class ModelReflections extends Collection{

    public $items;

    /**
     * @param array[String] $classes
     */
    public function __construct(Array $classes = array()){
        foreach($classes as $class){
            $this->add($class);
        }
    }

    /**
     * @param $model
     * @throws NotAValidModel
     * @return \MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection
     */
    public static function makeReflection($model){
        if(is_string($model)){
            return new \MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection($model);
        }

        if(\MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection::class == get_class($model))
            return $model;

        if($model == null){
            return null;
        }

        throw new NotAValidModel($model);
    }

    /**
     * @param mixed $model
     * @throws MezzoException
     * @internal param mixed $class
     * @return $this|void
     */
    public function add($model){
        $wrapper = $this->makeReflection($model);

        if(!$wrapper) return parent::add(null);

        $this->put($wrapper->className(), $wrapper);
    }


} 