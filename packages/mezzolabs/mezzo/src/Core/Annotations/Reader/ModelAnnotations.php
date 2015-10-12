<?php


namespace MezzoLabs\Mezzo\Core\Annotations\Reader;


use Doctrine\Common\Annotations\Reader as DoctrineReader;
use Illuminate\Database\Eloquent\Collection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflection;
use MezzoLabs\Mezzo\Exceptions\AnnotationException;

class ModelAnnotations
{
    /**
     * @var ModelReflection
     */
    protected $modelReflection;

    /**
     * @var array
     */
    protected $classAnnotations;

    /**
     * @var Collection
     */
    protected $attributeAnnotations;

    /**
     * @var Collection
     */
    protected $relationAnnotations;

    /**
     * @param ModelReflection $modelReflection
     */
    public function __construct(ModelReflection $modelReflection)
    {
        $this->modelReflection = $modelReflection;

        $this->read();

        $this->sendToCache();

        mezzo_dd($this);
    }

    protected function read()
    {
        $this->classAnnotations = $this->readClass();

        $this->readProperties();
    }

    /**
     * @return null|object
     */
    protected function readClass()
    {
        $reflectionClass = $this->reflectionClass();
        $classAnnotations = $this->doctrineReader()->getClassAnnotations($reflectionClass);

        return $classAnnotations;
    }

    /**
     * @return \ReflectionClass
     */
    public function reflectionClass()
    {
        return $this->modelReflection()->reflectionClass();
    }

    /**
     * @return ModelReflection
     */
    public function modelReflection()
    {
        return $this->modelReflection;

    }

    /**
     * @return DoctrineReader
     */
    protected function doctrineReader()
    {
        return $this->reader()->doctrineReader();

    }

    /**
     * @return \MezzoLabs\Mezzo\Core\Annotations\Reader\AnnotationReader
     */
    protected function reader()
    {
        return mezzo()->makeAnnotationReader();
    }

    /**
     * Read all the properties in the given model anc check for attribute and realtionship reflection.
     */
    protected function readProperties()
    {
        $this->attributeAnnotations = new Collection();
        $this->relationAnnotations = new Collection();

        $reflectionClass = $this->reflectionClass();
        $properties = new Collection($reflectionClass->getProperties(\ReflectionProperty::IS_PROTECTED));

        $properties->each(function (\ReflectionProperty $property) {
            $this->readProperty($property);
        });
    }

    /**
     * @param \ReflectionProperty $property
     * @return bool
     * @throws AnnotationException
     */
    protected function readProperty(\ReflectionProperty $property)
    {
        $annotations = PropertyAnnotations::make($this->reader(), $property);
        if ($annotations === null)
            return null;

        if ($annotations instanceof RelationAnnotations)
            return $this->relationAnnotations->put($annotations->name(), $annotations);

        if ($annotations instanceof AttributeAnnotations)
            return $this->attributeAnnotations->put($annotations->name(), $annotations);

        throw new AnnotationException('Unknown property ' . $annotations->name() .
            ' class ' . get_class($annotations));
    }

    /**
     * Save this model annotations to the runtime cache.
     */
    protected function sendToCache()
    {
        $this->reader()->cache($this);
    }

    /**
     * @return Collection
     */
    public function allAnnotations()
    {
        return $this->attributeAnnotations->merge($this->relationAnnotations);
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->modelReflection->className();
    }
}