<?php


namespace MezzoLabs\Mezzo\Core\Reflection\Reflections;


use MezzoLabs\Mezzo\Core\Reflection\ModelFinder;

class ModelReflectionSet
{
    /**
     * @var string
     */
    protected $className;

    /**
     * @var MezzoModelReflection
     */
    protected $mezzoModelReflection;

    /**
     * @var EloquentModelReflection
     */
    protected $eloquentModelReflection;

    /**
     * @var boolean
     */
    protected $isMezzoModel;

    /**
     * @param $className
     * @throws \ReflectionException
     */
    public function __construct($className)
    {
        if (!class_exists($className))
            throw new \ReflectionException('Class ' . $className . ' does not exist');

        $this->className = $className;
        $this->isMezzoModel = $this->checkIfMezzoModel();
    }

    /**
     * @return string
     */
    public function className()
    {
        return $this->className;
    }

    /**
     * @return MezzoModelReflection
     */
    public function mezzo()
    {
        if(!$this->isMezzoModel())
            return null;

        if($this->mezzoModelReflection === null)
            $this->mezzoModelReflection = new MezzoModelReflection($this);

        return $this->mezzoModelReflection;
    }

    /**
     * @return EloquentModelReflection
     */
    public function eloquent()
    {
        if($this->eloquentModelReflection === null){
            $this->eloquentModelReflection = new EloquentModelReflection($this);
        }
        return $this->eloquentModelReflection;
    }

    /**
     * @return bool
     */
    protected function checkIfMezzoModel(){
        return ModelFinder::classUsesMezzoTrait($this->className());
    }

    /**
     * @return boolean
     */
    public function isMezzoModel()
    {
        return $this->isMezzoModel;
    }


}