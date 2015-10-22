<?php


namespace MezzoLabs\Mezzo\Core\Modularisation;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\Modularisation\Http\Api\ApiResourceController;
use MezzoLabs\Mezzo\Core\Modularisation\Http\Html\ModulePage;
use MezzoLabs\Mezzo\Core\Modularisation\Http\Html\ModulePages;
use MezzoLabs\Mezzo\Core\Modularisation\Http\Html\ModuleResourceController;
use MezzoLabs\Mezzo\Core\Modularisation\Http\ModuleController;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflections;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflectionSet;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflectionSets;
use MezzoLabs\Mezzo\Core\Routing\ModuleRouter;
use MezzoLabs\Mezzo\Exceptions\DirectoryNotFound;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;
use MezzoLabs\Mezzo\Exceptions\ModuleControllerException;

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
     * @var ModuleRouter
     */
    protected $router;

    /**
     * @var ModulePages
     */
    protected $pages;


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

        $this->router = new ModuleRouter($this);

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
     * @param string $key
     * @return MezzoModelReflection
     */
    public function model($key)
    {
        return $this->reflectionSet($key)->mezzoReflection();
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
     * @return ModelReflections
     */
    public function models()
    {
        return $this->reflectionSets()->mezzoReflections();
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
    public function bindWithPrefix($shortAbstract, $concrete)
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
    public function makeWithPrefix($shortAbstract)
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
     * @throws ModuleControllerException
     */
    public function includeRoutes()
    {
        $this->router()->includeRoutesFile();
    }

    /**
     * @return ModuleRouter
     */
    public function router()
    {
        return $this->router;
    }

    /**
     * Create a new controller instance.
     *
     * @param $controllerName
     * @return ModuleController
     * @throws InvalidArgumentException
     * @throws ModuleControllerException
     */
    public function makeController($controllerName)
    {
        if (is_object($controllerName)) {
            if ($controllerName instanceof ModuleController) return $controllerName;

            throw new InvalidArgumentException($controllerName);
        }

        $controller = mezzo()->make($this->controllerClass($controllerName));

        if (!($controller instanceof ModuleController))
            throw new ModuleControllerException('Not a valid module controller.');

        return $controller;
    }

    /**
     * @param $name
     * @return ModulePage
     * @throws InvalidArgumentException
     * @throws \MezzoLabs\Mezzo\Exceptions\NamingConventionException
     */
    public function makePage($name)
    {
        if (is_object($name)) {
            if ($name instanceof ModulePage) return $name;

            throw new InvalidArgumentException($name);
        };

        $pageClass = NamingConvention::findPageClass($this, $name);

        return new $pageClass($this);
    }

    /**
     * Find the full class name for a controller.
     *
     * @param $controllerName
     * @return string
     * @throws ModuleControllerException
     */
    public function controllerClass($controllerName)
    {
        return NamingConvention::controllerClass($this, $controllerName);
    }

    /**
     * @return string
     */
    public function getNamespaceName()
    {
        return Singleton::reflection($this)->getNamespaceName();
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
     * @return ModulePages
     */
    public function pages()
    {
        if (!$this->pages)
            $this->pages = $this->collectPages();

        return $this->pages;
    }

    /**
     * Load views from the "views" folder inside the module root.
     * The namespace will be modules.<modulename>::<view_name>
     *
     * @throws DirectoryNotFound
     */
    protected function loadViews()
    {
        if (!is_dir($this->path() . '/Views'))
            throw new DirectoryNotFound($this->path() . '/Views');

        $this->loadViewsFrom($this->path() . '/Views', 'modules.' . $this->slug());
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
     * @param $controllerName
     * @return ModuleResourceController
     * @throws InvalidArgumentException
     * @throws ModuleControllerException
     */
    public function resourceController($controllerName)
    {
        $controller = $this->makeController($controllerName);

        if (!$controller->isResourceController())
            throw new ModuleControllerException($controller->qualifiedName() . ' is not a valid resource controller.');

        return $controller;
    }

    /**
     * Get the api resource controller with the ControllerName
     *
     * @param $controllerName
     * @return ModuleResourceController
     * @throws ModuleControllerException
     */
    public function apiResourceController($controllerName)
    {
        $controller = $this->resourceController($controllerName);

        if (!($controller instanceof ApiResourceController))
            throw new ModuleControllerException($controller->qualifiedName() . ' is not a API resource controller. ');

        return $controller;
    }

    protected function collectPages()
    {
        $pages = new ModulePages();
        $pages->collectFromModule($this);
        return $pages;
    }

}