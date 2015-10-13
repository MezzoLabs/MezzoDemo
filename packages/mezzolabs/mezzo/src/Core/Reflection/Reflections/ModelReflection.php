<?php

namespace MezzoLabs\Mezzo\Core\Reflection\Reflections;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use MezzoLabs\Mezzo\Core\Schema\Converters\Eloquent\ModelReflectionConverter;
use MezzoLabs\Mezzo\Core\Schema\ModelSchema;
use MezzoLabs\Mezzo\Exceptions\InvalidModel;

abstract class ModelReflection
{
    /**
     * @var ModelSchema
     */
    protected $schema;

    /**
     * @var ModelReflectionConverter
     */
    protected $schemaConverter;

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
        if (is_object($model) && $model instanceof ModelReflection)
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
     * Class name of the reflected eloquent model.
     *
     * @return string
     */
    public function className()
    {
        return $this->modelReflectionSet->className();
    }

    /**
     * Class name of the reflected eloquent model.
     *
     * @return EloquentModel
     */
    public function instance()
    {
        return $this->modelReflectionSet->instance();
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
     * @return \MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes
     */
    public function attributes()
    {
        return $this->schema()->attributes();
    }

    /**
     * @return \MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes
     */
    public function relations()
    {
        return $this->schema()->relations();
    }

    /**
     * @return boolean
     */
    public function isMezzoModel()
    {
        return $this instanceof MezzoModelReflection;
    }

    /**
     * @return \ReflectionClass
     */
    public function reflectionClass()
    {
        return $this->modelReflectionSet()->reflectionClass();
    }

    /**
     * @return ModelReflectionSet
     */
    public function modelReflectionSet()
    {
        return $this->modelReflectionSet;
    }

}
