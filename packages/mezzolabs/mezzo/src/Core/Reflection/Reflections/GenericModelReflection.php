<?php

namespace MezzoLabs\Mezzo\Core\Reflection\Reflections;

use Illuminate\Database\Eloquent\Model;
use MezzoLabs\Mezzo\Core\Reflection\ModelParser;
use MezzoLabs\Mezzo\Core\Schema\Converters\ModelReflectionConverter;
use MezzoLabs\Mezzo\Core\Schema\ModelSchema;
use MezzoLabs\Mezzo\Exceptions\InvalidModel;

abstract class GenericModelReflection
{
    /**
     * One example instance of the wrapped model.
     *
     * @var Model
     */
    protected $instance;

    /**
     * @var ModelSchema
     */
    protected $schema;

    /**
     * @var ModelReflectionConverter
     */
    protected $schemaConverter;

    /**
     * @var \ReflectionClass
     */
    protected $reflectionClass;

    /**
     * @var ModelParser
     */
    protected $parser;

    /**
     * @var ModelReflectionSet
     */
    private $modelReflectionSet;

    /**
     * Constructor is private so the factory method has to be used.
     * This enables us to cache the reflections in an easy way.
     *
     * @param ModelReflectionSet $modelReflectionSet
     */
    public function __construct(ModelReflectionSet $modelReflectionSet)
    {
        $this->modelReflectionSet = $modelReflectionSet;

        $this->schemaConverter = ModelReflectionConverter::make();

        mezzo()->makeReflectionManager()->addToMapping($this);
    }

    /**
     * @param $model
     * @return mixed
     * @throws InvalidModel
     */
    public static function modelStringOrFail($model)
    {
        $modelString = static::modelString($model);

        if (!$modelString)
            throw new InvalidModel($model);

        return $modelString;
    }

    /**
     * Normalize the variable to a model string.
     *
     * @param $model
     * @return null|string
     */
    public static function modelString($model)
    {
        if (is_object($model) && $model instanceof GenericModelReflection)
            return $model->className();

        if (is_object($model))
            return get_class($model);

        if (class_exists($model))
            return $model;

        if (class_exists('App\\' . ucfirst($model)))
            return 'App\\' . ucfirst($model);

        return null;
    }

    /**
     * @return Model
     */
    public function instance()
    {
        if (!$this->instance) {
            $this->instance = mezzo()->make($this->className());
        }

        return $this->instance;
    }

    /**
     * Class name of the reflected eloquent model.
     *
     * @return string
     */
    public function className()
    {
        return $this->modelReflectionSet->className();
    }

    /**
     * @return string
     */
    public function fileName()
    {
        return $this->reflectionClass()->getFileName();
    }

    /**
     * Get the ReflectionClass object of the underlying model
     *
     * @return \ReflectionClass
     */
    public function reflectionClass()
    {
        if (!$this->reflectionClass) {
            $this->reflectionClass = new \ReflectionClass($this->className());
        }

        return $this->reflectionClass;
    }

    /**
     * @return string
     */
    public function shortName()
    {
        return $this->reflectionClass()->getShortName();
    }

    /**
     * @return ModelSchema
     */
    public function schema()
    {
        if (!$this->schema) {
            $this->schema = $this->schemaConverter->run($this);
        }

        return $this->schema;
    }

    /**
     * @return boolean
     */
    public function isMezzoModel()
    {
        return $this instanceof MezzoModelReflection;
    }

    /**
     * @return ModelReflectionSet
     */
    public function modelReflectionSet()
    {
        return $this->modelReflectionSet;
    }

}
