<?php


namespace MezzoLabs\Mezzo\Core;


use Illuminate\Foundation\Application;
use MezzoLabs\Mezzo\Core\Booting\BootManager;
use MezzoLabs\Mezzo\Core\Configuration\MezzoConfig;
use MezzoLabs\Mezzo\Core\Helpers\Path;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleCenter;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\Reflector;
use MezzoLabs\Mezzo\Events\Core\MezzoBooted;
use MezzoLabs\Mezzo\Events\Event;
use MezzoLabs\Mezzo\MezzoServiceProvider;

class Mezzo{

    /**
     * Indicates if mezzo has "booted".
     *
     * @var bool
     */
    protected $booted = false;


    /**
     * The Laravel Application
     *
     * @var Application
     */
    protected $app;


    /**
     * The core boot service that runs all the bootstrappers we need.
     *
     * @var BootManager
     */
    protected $bootManager;

    /**
     * The mezzo service provider that starts all this stuff.
     *
     * @var MezzoServiceProvider
     */
    public $serviceProvider;

    /**
     * Create the one and only Mezzo instance
     *
     * @param Application $app
     */
    public function __construct(Application $app){
        $this->app = $app;

        $this->bootManager = BootManager::make($this);
    }

    /**
     * Get the Laravel application
     *
     * @return Application
     */
    public function app(){
        return $this->app;
    }

    /**
     * Returns the main Module Center instance.
     *
     * @return ModuleCenter
     */
    public function moduleCenter(){
        return $this->make(ModuleCenter::class);
    }

    /**
     * Return the model reflector instance.
     *
     * @return Reflector
     */
    public function reflector(){
        return $this->make(Reflector::class);
    }

    /**
     * Get a module instance by key(slug or class name)
     *
     * @param $key
     * @return \MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider
     */
    public function module($key){
        return $this->moduleCenter()->getModule($key);
    }

    /**
     * Returns the main MezzoConfig instance
     *
     * @return MezzoConfig
     */
    public function config(){
        return $this->make(MezzoConfig::class);
    }

    /**
     * Bootstrap Mezzo
     */
    public function bootstrap(){
        if($this->booted) return false;
    }

    /**
     * Run the boot services that we need at the time the Mezzo provider is registered
     */
    public function onProviderRegistered(){
        $this->bootManager->registerPhase();
    }

    /**
     * Run the boot services that we need at the time the when all service providers are registered
     */
    public function onProviderBooted(){
        $this->bootManager->bootPhase();
    }

    /**
     * Run the boot services that we need at the time the when all service providers are booted
     */
    public function onAllProvidersBooted(){
        if($this->booted) return false;

        $this->bootManager->bootedPhase();

        $this->booted = true;

        $this->fire(MezzoBooted::class);

    }

    /**
     * A quick access for the Laravel IoC Container
     *
     * @param $abstract
     * @param array $parameters
     * @return mixed
     */
    public function make($abstract, $parameters = []){
        return $this->app->make($abstract, $parameters);
    }

    /**
     * Throw a Mezzo event
     *
     * @param $event
     * @param  mixed $payload
     * @param  bool $halt
     * @return array|null
     */
    public function fire( $event, $payload = [], $halt = false){
        event($event, $payload, $halt);
    }

    /**
     * Gives you access to the Path helper singleton
     *
     * @return Path
     */
    public function path(){
        return $this->app()->make('mezzo.path');
    }




} 