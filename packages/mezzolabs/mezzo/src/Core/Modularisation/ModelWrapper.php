<?php


namespace MezzoLabs\Mezzo\Core\Modularisation;


use MezzoLabs\Mezzo\Exceptions\ModelIsAlreadyAssociated;

class ModelWrapper
{
    /**
     * @var string Name of the eloquent class that is wrapped
     */
    private $className;

    /**
     * @var ModuleProvider
     */
    private $module;

    /**
     * @param $className
     */
    public function __construct($className)
    {

        $this->className = $className;
    }

    /**
     * @return string
     */
    public function className()
    {
        return $this->className;
    }

    /**
     * @return ModuleProvider
     */
    public function module(){
        return $this->module;
    }

    /**
     * @param ModuleProvider $module
     * @throws ModelIsAlreadyAssociated
     */
    public function setModule(ModuleProvider $module)
    {
        if($this->hasModule()){
            throw new ModelIsAlreadyAssociated($this, $module);
        }
        $this->module = $module;

        $this->module->associateModel($this);
    }

    /** Check if there is a module that wants to use this model.
     * @return bool
     */
    public function hasModule(){
       return $this->module != null;
    }


} 