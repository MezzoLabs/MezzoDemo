<?php


namespace MezzoLabs\Mezzo\Core\Modularisation;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflections;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflectionSet;
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
    protected $modelReflectionSets;

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
        $this->modelReflectionSets = new ModelReflectionSets();
        $this->app = $app;
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
    public function reflectionSets()
    {
        return $this->modelReflectionSets;
    }

    /**
     * @param string $key
     * @return MezzoModelReflection
     */
    public function model($key)
    {
        return $this->reflectionSet($key)->mezzoReflection();
    }

    /**
     * @return ModelReflections
     */
    public function models()
    {
        return $this->reflectionSets()->mezzoReflections();
    }

    /**
     * @param $key
     * @return ModelReflectionSet
     */
    public function reflectionSet($key)
    {
        return $this->modelReflectionSets->getReflectionSet($key);
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
     * @param ModelReflection|ModelReflectionSet $modelReflectionSet
     * @throws \MezzoLabs\Mezzo\Exceptions\ReflectionException
     */
    public function associateModel(ModelReflectionSet $modelReflectionSet)
    {
        $this->modelReflectionSets->addReflectionSet($modelReflectionSet);
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
     * @return \ReflectionClass
     */
    public function reflection()
    {
        return Singleton::reflection(get_class($this));
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
     * @internal param MezzoKernel $kernel
     */
    public function loadCommands()
    {
        $this->mezzo->kernel()->registerCommands($this->commands);
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
     * Path to the module folder
     *
     * @return string
     */
    public function path()
    {
        $fileName = $this->reflection()->getFileName();
        return dirname($fileName);
    }
}