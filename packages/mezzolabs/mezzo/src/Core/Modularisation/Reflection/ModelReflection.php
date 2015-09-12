<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Reflection;


use Illuminate\Database\Eloquent\Model;
use MezzoLabs\Mezzo\Core\Database\Table;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Exceptions\ModelIsAlreadyAssociated;

class ModelReflection
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
     * @var Table
     */
    protected $databaseTable;

    /**
     * One example instance of the wrapped model.
     *
     * @var Model
     */
    protected $instance;

    /**
     * @param $className
     */
    public function __construct($className)
    {
        $this->className = $className;

        $this->analyseModel();
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
     * @return \MezzoLabs\Mezzo\Core\Database\Table
     */
    public function table()
    {
        return $this->databaseTable;
    }

    /**
     * @return Model
     */
    public function instance()
    {
        if(!$this->instance){
            $this->instance = mezzo()->make($this->className);
        }

        return $this->instance;
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

    protected function analyseModel()
    {
        $this->databaseTable = Table::fromWrapper($this);
    }




} 