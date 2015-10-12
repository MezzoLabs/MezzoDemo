<?php


namespace MezzoLabs\Mezzo\Core\Annotations\Reader;


use Doctrine\Common\Annotations\Reader as DoctrineReader;
use Illuminate\Database\Eloquent\Collection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflection;

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
     * @param ModelReflection $modelReflection
     */
    public function __construct(ModelReflection $modelReflection)
    {
        $this->modelReflection = $modelReflection;

        $this->read();

        $this->sendToCache();
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
     * Read all the properties in the given model anc check for attribute and realtionship reflection.
     */
    protected function readProperties()
    {
        $attributeAnnotations = new Collection();
        $relationAnnotations = new Collection();

        $reflectionClass = $this->reflectionClass();
        $properties = new Collection($reflectionClass->getProperties(\ReflectionProperty::IS_PROTECTED));
        $reader = $this->doctrineReader();

        $properties->each(function (\ReflectionProperty $property) use ($reader){
            if(!$property->isProtected()) return true;

            $annotations = $reader->getPropertyAnnotations($property);

            if(empty($annotations)) return true;

            mezzo_dd($annotations);


        });

        mezzo_dd();
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

    protected function sendToCache()
    {
        $this->reader()->cache($this);

    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->modelReflection->classNass();
    }
}