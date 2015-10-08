<?php


namespace MezzoLabs\Mezzo\Core\Modularisation;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\GenericModelReflection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflectionSets;
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
     * @var ModelReflectionSets
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
        $this->modelReflections = new ModelReflectionSets();
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
     * @return ModelReflectionSets
     */
    public function models()
    {
        return $this->modelReflections;
    }

    /**
     * @param string $key
     * @return GenericModelReflection
     */
    public function model($key)
    {
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
    public function slug()
    {
        $class = $this->reflection()->getShortName();
        $class = preg_replace('/Module/', '', $class);

        return str_slug($class);
    }

    /**
     * @param GenericModelReflection $model
     */
    public function associateModel(GenericModelReflection $model)
    {
        $this->modelReflections->add($model);
    }

    /**
     * Path to the module folder
     *
     * @return string
     */
    public function path()
    {
        $fileName = $this->reflection()->getFileName();
        return dirname($fileName);
    }


    /**
     * @return \ReflectionClass
     */
    public function reflection()
    {
        return Singleton::reflection(get_class($this));
    }

    /**
     * @param $shortAbstract
     * @param $concrete
     */
    public function bindWithNamespace($shortAbstract, $concrete)
    {
        $abstract = 'modules.' . $this->slug() . '.' . $shortAbstract;

        $this->app->bind($abstract, $concrete);
    }

    /**
     * @param $shortAbstract
     * @return mixed
     */
    public function makeWithNamespace($shortAbstract)
    {
        return $this->app->make('modules.' . $this->slug() . '.' . $shortAbstract);
    }


    /**
     * Load views from the "views" folder inside the module root.
     * The namespace will be modules.<modulename>::<view_name>
     *
     * @throws DirectoryNotFound
     */
    protected function loadViews()
    {
        if (!is_dir($this->path() . '/views'))
            throw new DirectoryNotFound($this->path() . '/views');

        $this->loadViewsFrom($this->path() . '/views', 'modules.' . $this->slug());
    }


    /**
     * @internal param MezzoKernel $kernel
     */
    public function loadCommands()
    {
        $this->mezzo->kernel()->registerCommands($this->commands);
    }

    /**
     * Factory method for creating a Mezzo module instance.
     *
     * @return ModuleProvider
     */
    public static function make()
    {
        return mezzo()->module(static::class);
    }


}