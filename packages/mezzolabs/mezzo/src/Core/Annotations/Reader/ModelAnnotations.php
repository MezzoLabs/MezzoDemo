<?php


namespace MezzoLabs\Mezzo\Core\Annotations\Reader;


use Doctrine\Common\Annotations\Reader as DoctrineReader;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflection;

class ModelAnnotations
{
    /**
     * @var ModelReflection
     */
    protected $modelReflection;

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

    public function name()
    {
        return $this->modelReflection->className();
    }
}