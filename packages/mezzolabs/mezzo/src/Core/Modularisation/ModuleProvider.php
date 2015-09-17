<?php


namespace MezzoLabs\Mezzo\Core\Modularisation;


use Illuminate\Support\ServiceProvider;
use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflections;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;
use MezzoLabs\Mezzo\Exceptions\DirectoryNotFound;

abstract class ModuleProvider extends ServiceProvider
{

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
    public function modelClasses()
    {
        return $this->models;
    }

    /**
     * The reflections of the associated models
     *
     * @internal param bool $key
     * @return ModelReflections
     */
    public function models(){
        return $this->modelReflections;
    }

    /**
     * @param string $key
     * @return ModelReflection
     */
    public function model($key){
        return $this->modelReflections->get($key);
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
        $class = preg_replace('/Module/', '', $class);

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
        return Singleton::reflection(get_class($this));
    }


    public function loadViews(){
        if(!is_dir($this->path() . '/views'))
            throw new DirectoryNotFound($this->path() . '/views');

        $this->loadViewsFrom($this->path() . '/views', 'modules.' . $this->slug());
    }




}