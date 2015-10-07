<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Reflection;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as IlluminateCollection;
use MezzoLabs\Mezzo\Exceptions\InvalidModel;
use MezzoLabs\Mezzo\Exceptions\MezzoException;

class ModelReflections extends Collection
{
    public $items;

    /**
     * @var Collection
     */
    public $aliases;

    /**
     * @var Collection
     */
    public $tableNames;


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
     * @return \MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection
     */
    public static function makeReflection($model)
    {
        if (is_string($model))
            return ModelReflection::make($model);

        if ($model instanceof ModelReflection)
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
        $this->addAlias($reflection);

        return $reflection;
    }

    /**
     * Add an alias so you can find the models via their short name.
     * (Tutorial instead of \App\Learning\Tutorial)
     *
     * @param ModelReflection $reflection
     */
    protected function addAlias(ModelReflection $reflection)
    {
        $this->aliases->put(strtolower($reflection->shortName()), $reflection);

        $this->tableNames->put(strtolower($reflection->instance()->getTable()), $reflection);
    }

    /**
     * @param $model
     * @return $this|ModelReflections|mixed|void
     * @internal param null $default
     */
    public function getOrCreate($model)
    {
        $key = $this->modelString($model);

        if ($this->has($key))
            return parent::get($key);
        else
            return $this->add($model);
    }

    /**
     * @param mixed $model
     * @param null $default
     * @internal param mixed $key
     * @return ModelReflection
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
     * Normalize the variable to a model string.
     *
     * @param $model
     * @return mixed
     */
    public function modelString($model)
    {
        if (is_object($model) && $model instanceof ModelReflection)
            return $model->className();

        if (is_object($model))
            return get_class($model);

        if (class_exists($model))
            return $model;

        if (class_exists('App\\' . ucfirst($model)))
            return 'App\\' . ucfirst($model);

        throw new InvalidModel($model);
    }

    /**
     * @param string $tableName
     * @return ModelReflection
     */
    public function byTable($tableName)
    {
        return $this->tableNames->get($tableName);
    }


}