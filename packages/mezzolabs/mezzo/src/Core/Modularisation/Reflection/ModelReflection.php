<?php

namespace MezzoLabs\Mezzo\Core\Modularisation\Reflection;

use Illuminate\Database\Eloquent\Model;
use MezzoLabs\Mezzo\Core\Schema\Converters\ModelReflectionConverter;
use MezzoLabs\Mezzo\Core\Schema\ModelSchema;

abstract class ModelReflection
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
     * @var string Name of the eloquent class that is wrapped
     */
    private $className;

    /**
     * @param $className
     * @throws \ReflectionException
     */
    public function __construct($className)
    {
        $this->className = $className;

        if (!class_exists($className)) {
            throw new \ReflectionException('Class ' . $className . ' does not exist');
        }

        $this->schemaConverter = ModelReflectionConverter::make();
    }

    /**
     * Produces a new model reflection.
     * Creates an EloquentModelReflection if the model isnt analysed yet and doest use the MezzoTrait.
     *
     * @param $className
     * @param bool $forceEloquentReflection force the usage of an eloquent reflection to take a look at the database
     *
     * @return EloquentModelReflection|MezzoModelReflection
     */
    public static function make($className, $forceEloquentReflection = false)
    {
        if (mezzo()->reflector()->classUsesMezzoTrait($className) && !$forceEloquentReflection)
            return new MezzoModelReflection($className);

        return new EloquentModelReflection($className);
    }

    /**
     * @return string
     */
    public function className()
    {
        return $this->className;
    }

    /**
     * @return Model
     */
    public function instance()
    {
        if (!$this->instance) {
            $this->instance = mezzo()->make($this->className);
        }

        return $this->instance;
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
            $this->reflectionClass = new \ReflectionClass($this->className);
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
}
