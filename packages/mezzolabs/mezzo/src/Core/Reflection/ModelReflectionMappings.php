<?php


namespace MezzoLabs\Mezzo\Core\Reflection;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\GenericModelReflection;
use MezzoLabs\Mezzo\Exceptions\MezzoException;

class ModelReflectionMappings
{
    /**
     * @var Collection
     */
    public $aliases;

    /**
     * @var Collection
     */
    public $tableNames;

    public function __construct()
    {
        $this->aliases = new Collection();
        $this->tableNames = new Collection();
    }

    public function add(GenericModelReflection $reflection)
    {
        $this->aliases->put(strtolower($reflection->shortName()), $reflection->className());
        $this->tableNames->put(strtolower($reflection->instance()->getTable()), $reflection->className());
    }

    /**
     * @param $model
     * @return GenericModelReflection|null
     * @throws MezzoException
     */
    public function findClassName($model)
    {
        $modelClassName = GenericModelReflection::modelString($model);

        if()

        if(!is_string($model))
            throw new MezzoException('Cannot find a model mapping for a non string.');

        $key = strtolower($model);

        if($this->tableNames->has($key))
            return $this->tableNames->get($key);

        if($this->aliases->has($key))
            return $this->aliases->get($key);

        return null;
    }
}