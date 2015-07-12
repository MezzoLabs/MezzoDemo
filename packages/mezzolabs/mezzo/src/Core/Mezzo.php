<?php


namespace MezzoLabs\Mezzo\Core;


use Illuminate\Foundation\Application;
use MezzoLabs\Mezzo\Core\Booting\BootManager;
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
     * @param Event $event
     * @param  mixed $payload
     * @param  bool $halt
     * @return array|null
     */
    public function fire(Event $event, $payload = [], $halt = false){
        event($event, $payload, $halt);
    }


} 