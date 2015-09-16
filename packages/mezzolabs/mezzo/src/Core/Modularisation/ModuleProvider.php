<?php


namespace MezzoLabs\Mezzo\Core\Modularisation;


use Illuminate\Support\ServiceProvider;
use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflections;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;

abstract class ModuleProvider extends ServiceProvider
{

    protected $isCoreModule = false;

    /**
     * @var String[]
     */
    protected $models = [];

    /**
     * @var ModelReflections
     */
    protected $modelReflections;

    /**
     * @var Mezzo
     */
    private $mezzo;

    /**
     * Create a new module provider instance
     *
     * @param Mezzo $mezzo
     */
    public function __construct(Mezzo $mezzo)
    {
        $this->mezzo = $mezzo;

        parent::__construct($this->mezzo->app());

        $this->modelReflections = new ModelReflections();
    }

    /**
     * Called when module is ready, model reflections are loaded.
     *
     * @return mixed
     */
    abstract public function ready();

    /**
     * @return \String[]
     */
    public function models()
    {
        return $this->models;
    }

    /**
     * Returns the unique identifier of this module.
     *
     * @return string
     */
    public function identifier()
    {
        return get_class($this);
    }

    /**
     * Returns the key of the module based on the ModuleProvider class name in snake case.
     *
     * Example: MySampleModule -> my-sample
     *
     * @return string
     */
    public function slug(){
        $class = $this->reflection()->getShortName();
        $class = rtrim($class, 'Module');

        return str_slug($class);
    }

    /**
     * @param ModelReflection $model
     */
    public function associateModel(ModelReflection $model)
    {
        $this->modelReflections->add($model);
    }

    /**
     * The reflections of the associated models
     *
     * @return ModelReflections
     */
    public function modelReflections(){
        return $this->modelReflections;
    }

    /**
     * Path to the module folder
     *
     * @return string
     */
    public function path(){
        $fileName = $this->reflection()->getFileName();
        return dirname($fileName);
    }


    /**
     * @return \ReflectionClass
     */
    public function reflection(){
        $module = get_class($this);
        return Singleton::get('moduleReflections.' . get_class($this), function() use ($module){
                return new \ReflectionClass($module);
            });
    }

    /**
     * @return bool
     */
    public function isCoreModule(){
        return $this->isCoreModule;
    }




}