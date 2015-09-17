<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Reflection;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Cache\Singleton;
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
     * @var \ReflectionClass
     */
    protected $reflectionClass;

    /**
     * @var Parser
     */
    protected $parser;

    /**
     * @var Collection
     */
    protected $relationships;

    /**
     * @param $className
     * @throws \ReflectionException
     */
    public function __construct($className)
    {
        $this->className = $className;

        if(!class_exists($className)){
            throw new \ReflectionException('Class ' . $className . ' does not exist');
        }

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
        if(!$this->databaseTable)
            $this->databaseTable = Table::fromWrapper($this);

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

    /**
     * Get the ReflectionClass object of the underlying model
     *
     * @return \ReflectionClass
     */
    public function reflectionClass(){
        if(!$this->reflectionClass){
            $this->reflectionClass = new \ReflectionClass($this->className);
        }

        return $this->reflectionClass;
    }

    /**
     * Get the ReflectionClass object of the underlying model
     *
     * @return Parser
     */
    public function parser(){
        if(!$this->parser){
            $this->parser = new Parser($this);
        }

        return $this->parser;
    }

    /**
     * @return string
     */
    public function fileName(){
        return $this->reflectionClass()->getFileName();
    }

    /**
     * @return string
     */
    public function shortName(){
        return $this->reflectionClass()->getShortName();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|Collection
     */
    public function relationships(){
        if(!$this->relationships){
            $this->relationships = $this->parser()->relationships();
        }

        return $this->relationships;
    }





} 