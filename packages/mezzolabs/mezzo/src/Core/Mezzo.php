<?php


namespace MezzoLabs\Mezzo\Core;


use Illuminate\Foundation\Application;
use MezzoLabs\Mezzo\Core\Booting\BootManager;
use MezzoLabs\Mezzo\Core\Traits\CanFireEvents;
use MezzoLabs\Mezzo\Core\Traits\CanMakeInstances;
use MezzoLabs\Mezzo\Events\Core\MezzoBooted;
use MezzoLabs\Mezzo\MezzoServiceProvider;

class Mezzo
{

    use CanMakeInstances, CanFireEvents;

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
    public function __construct(Application $app)
    {
        $this->app = $app;

        $this->bootManager = BootManager::make($this);
    }

    /**
     * Get the Laravel application
     *
     * @return Application
     */
    public function app()
    {
        return $this->app;
    }

    /**
     * Get a module instance by key(slug or class name)
     *
     * @param $key
     * @return \MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider
     */
    public function module($key)
    {
        return $this->moduleCenter()->getModule($key);
    }

    /**
     * Run the boot services that we need at the time the Mezzo provider is registered
     */
    public function onProviderRegistered()
    {
        $this->bootManager->runRegisterPhase();
    }

    /**
     * Run the boot services that we need at the time the when all service providers are registered
     */
    public function onProviderBooted()
    {
        $this->bootManager->runBootPhase();
    }

    /**
     * Run the boot services that we need at the time the when all service providers are booted
     */
    public function onAllProvidersBooted()
    {
        if ($this->booted) return false;

        $this->bootManager->bootedPhase();

        $this->booted = true;

        $this->fire(MezzoBooted::class);

    }


}