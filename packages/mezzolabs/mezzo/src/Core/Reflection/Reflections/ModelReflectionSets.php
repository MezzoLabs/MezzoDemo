<?php


namespace MezzoLabs\Mezzo\Core\Reflection\Reflections;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as IlluminateCollection;
use MezzoLabs\Mezzo\Exceptions\InvalidModel;
use MezzoLabs\Mezzo\Exceptions\MezzoException;

class ModelReflectionSets extends Collection
{
    public $items;

    /**
     * @param array $classes
     * @internal param mixed $items
     */
    public function __construct($classes = [])
    {
        $this->aliases = new Collection();
        $this->tableNames = new Collection();

        if ((is_array($classes) || is_a($classes, IlluminateCollection::class))
            && count($classes) > 0
        ) {
            foreach ($classes as $class) {
                $this->add($class);
            }
        } else {
            parent::__construct($classes);
        }
    }

    /**
     * @param $model
     * @throws InvalidModel
     * @return \MezzoLabs\Mezzo\Core\Reflection\Reflections\GenericModelReflection
     */
    public static function makeReflection($model)
    {
        if ($model == null)
            return null;


        GenericModelReflection::modelStringOrFail($model);

        if (is_string($model))
            return GenericModelReflection::make($model);


        if ($model instanceof GenericModelReflection)
            return $model;



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
        $this->addAlias($reflection);

        return $reflection;
    }

    /**
     * Add an alias so you can find the models via their short name.
     * (Tutorial instead of \App\Learning\Tutorial)
     *
     * @param GenericModelReflection $reflection
     */
    protected function addAlias(GenericModelReflection $reflection)
    {
        $this->aliases->put(strtolower($reflection->shortName()), $reflection);

        $this->tableNames->put(strtolower($reflection->instance()->getTable()), $reflection);
    }

    /**
     * @param mixed $model
     * @param null $default
     * @internal param mixed $key
     * @return GenericModelReflection
     */
    public function get($model, $default = null)
    {
        if ($this->has($model))
            return parent::get($model);

        if ($this->has('App\\' . $model))
            return parent::get('App\\' . $model);

        if ($this->aliases->has(strtolower($model)))
            return $this->aliases->get(strtolower($model), $default);

        if ($this->tableNames->has(strtolower($model))) {
            return $this->tableNames->get(strtolower($model), $default);
        }

        return parent::get($model, $default);
    }

    /**
     * Check if this reflection collection has the model.
     *
     * @param $model
     * @return bool
     */
    public function hasModel($model)
    {
        return $this->get($model, false) !== false;
    }

    /**
     * @param $model
     * @return $this|ModelReflectionSets|mixed|void
     * @internal param null $default
     */
    public function getOrCreate($model)
    {
        $key = GenericModelReflection::modelStringOrFail($model);

        if ($this->has($key))
            return parent::get($key);
        else
            return $this->add($model);
    }

    /**
     * @param string $tableName
     * @return GenericModelReflection
     */
    public function byTable($tableName)
    {
        return $this->tableNames->get($tableName);
    }


}