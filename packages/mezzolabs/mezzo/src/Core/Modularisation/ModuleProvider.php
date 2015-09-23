<?php


namespace MezzoLabs\Mezzo\Core\Modularisation;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use MezzoLabs\Mezzo\Console\MezzoKernel;
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
     * These MezzoCommands will be registered for the artisan command line.
     *
     * @var array
     */
    protected $commands = [];

    /**
     * @var ModelReflections
     */
    protected $modelReflections;

    /**
     * @var Mezzo
     */
    protected $mezzo;

    /**
     * Create a new module provider instance
     *
     * @param Application $app
     * @internal param Application $app
     * @internal param Mezzo $mezzo
     */
    public function __construct(Application $app)
    {
        $this->mezzo = mezzo();;
        $this->modelReflections = new ModelReflections();
        $this->app = $app;
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
    public function qualifiedName()
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

    /**
     * @param $shortAbstract
     * @param $concrete
     */
    public function bind($shortAbstract, $concrete){
        $abstract = 'modules.' . $this->slug() . '.' . $shortAbstract;

        $this->app->bind($abstract, $concrete);
    }


    /**
     * Load views from the "views" folder inside the module root.
     * The namespace will be modules.<modulename>::<view_name>
     *
     * @throws DirectoryNotFound
     */
    protected function loadViews(){
        if(!is_dir($this->path() . '/views'))
            throw new DirectoryNotFound($this->path() . '/views');

        $this->loadViewsFrom($this->path() . '/views', 'modules.' . $this->slug());
    }


    /**
     * @internal param MezzoKernel $kernel
     */
    public function loadCommands(){
        $this->mezzo->kernel()->registerCommands($this->commands);
    }



}