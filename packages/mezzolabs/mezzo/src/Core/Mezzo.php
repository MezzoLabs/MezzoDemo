<?php


namespace MezzoLabs\Mezzo\Core;


use Illuminate\Foundation\Application;
use MezzoLabs\Mezzo\Core\Booting\BootManager;

class Mezzo extends Application{

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
     * Run the boot services that we need at the time the when all service providers are booted
     */
    public function onProviderBooted(){
        if($this->booted) return false;

        $this->bootManager->bootPhase();

        $this->booted = true;
    }



} 