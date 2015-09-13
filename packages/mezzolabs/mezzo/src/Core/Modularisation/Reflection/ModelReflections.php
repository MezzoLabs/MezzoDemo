<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Reflection;


use Illuminate\Database\Eloquent\Collection;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;
use MezzoLabs\Mezzo\Exceptions\MezzoException;
use MezzoLabs\Mezzo\Exceptions\InvalidModel;

class ModelReflections extends Collection
{

    public $items;

    /**
     * @param array [String] $classes
     */
    public function __construct(Array $classes = array())
    {
        foreach ($classes as $class) {
            $this->add($class);
        }
    }

    /**
     * @param $model
     * @throws InvalidModel
     * @return \MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection
     */
    public static function makeReflection($model)
    {

        if (is_string($model)) {
            return new \MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection($model);
        }

        if (\MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection::class == get_class($model))
            return $model;

        if ($model == null) {
            return null;
        }

        throw new InvalidModel($model);
    }

    /**
     * @param mixed $model
     * @throws MezzoException
     * @internal param mixed $class
     * @return $this|void
     */
    public function add($model)
    {
        $reflection = $this->makeReflection($model);


        if (!$reflection) return parent::add(null);

        $this->put($reflection->className(), $reflection);
    }

    /**
     * @param $model
     * @param null $default
     * @return $this|ModelReflections|mixed|void
     */
    public function getOrCreate($model)
    {
        $key = $this->modelString($model);


        if ($this->has($key))   return parent::get($key);
        else                    return $this->add($model);
    }

    /**
     * @param mixed $model
     * @param null $default
     * @internal param mixed $key
     * @return ModelReflection
     */
    public function get($model, $default = null)
    {

        if($this->has($model))
            return parent::get($model);

        if($this->has('App\\' . $model))
            return parent::get('App\\' . $model);

        return parent::get($model, $default);
    }

    public function modelString($model){
        if(is_object($model) && get_class($model) == ModelReflection::class)
            return $model->className();
        if(is_string($model)) return $model;

        throw new InvalidModel($model);
    }


} 