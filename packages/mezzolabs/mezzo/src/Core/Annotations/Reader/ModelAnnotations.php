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

    protected function read(){
        $this->classAnnotations = $this->readClass();
    }

    /**
     * @return null|object
     */
    protected function readClass(){
        $reflectionClass = $this->reflectionClass();
        $classAnnotations = $this->doctrineReader()->getClassAnnotations($reflectionClass);
        $attributesAnnotations = $this->readAttributes();

        mezzo_dd($attributesAnnotations);
        return $classAnnotations;
    }

    protected function readAttributes(){
        $attributes = new Collection();

        $reflectionClass = $this->reflectionClass();
        $properties = $reflectionClass->getProperties();

        mezzo_dd($properties);

    }

    protected function sendToCache()
    {
        $this->reader()->cache($this);
    }

    /**
     * @return \MezzoLabs\Mezzo\Core\Annotations\Reader\AnnotationReader
     */
    protected function reader()
    {
        return mezzo()->makeAnnotationReader();
    }

    /**
     * @return DoctrineReader
     */
    protected function doctrineReader(){
        return $this->reader()->doctrineReader();
    }

    /**
     * @return ModelReflection
     */
    public function modelReflection()
    {
        return $this->modelReflection;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->modelReflection->className();
    }

    /**
     * @return \ReflectionClass
     */
    public function reflectionClass()
    {
        return $this->modelReflection()->reflectionClass();
    }
}