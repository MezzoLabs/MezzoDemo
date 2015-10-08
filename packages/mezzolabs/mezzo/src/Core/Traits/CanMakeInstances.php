<?php
/**
 * Created by: simon.schneider
 * Date: 17.09.2015 - 15:20
 * Project: MezzoDemo
 */


namespace MezzoLabs\Mezzo\Core\Traits;


use MezzoLabs\Mezzo\Console\MezzoKernel;
use MezzoLabs\Mezzo\Core\Configuration\MezzoConfig;
use MezzoLabs\Mezzo\Core\Database\Reader;
use MezzoLabs\Mezzo\Core\Helpers\Path;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleCenter;
use MezzoLabs\Mezzo\Core\Reflection\ModelFinder;
use MezzoLabs\Mezzo\Core\Reflection\ReflectionManager;
use MezzoLabs\Mezzo\Core\Reflection\Reflectors\MezzoModelsReflector;

trait CanMakeInstances
{
    /**
     * A quick access for the Laravel IoC Container
     *
     * @param $abstract
     * @param array $parameters
     * @return mixed
     */
    public function make($abstract, $parameters = [])
    {
        return app()->make($abstract, $parameters);
    }

    /**
     * Returns the main Module Center instance.
     *
     * @return ModuleCenter
     */
    public function moduleCenter()
    {
        return $this->make(ModuleCenter::class);
    }

    /**
     * Returns the main Mezzo Console Kernel instance
     *
     * @return MezzoKernel
     */
    public function kernel()
    {
        return $this->make(MezzoKernel::class);
    }

    /**
     * Return the mezzo models reflector instance.
     *
     * @return MezzoModelsReflector
     */
    public function reflector()
    {
        return $this->makeReflectionManager()->mezzoModelsReflector();
    }

    /**
     * @return ReflectionManager
     */
    public function makeReflectionManager()
    {
        return $this->make(ReflectionManager::class);
    }

    /**
     * Return the model reflector singleton instance.
     *
     * @return Reader
     */
    public function makeDatabaseReader()
    {
        return $this->make(Reader::class);
    }

    /**
     * Return the model finder singleton instance.
     *
     * @return ModelFinder
     */
    public function makeModelFinder()
    {
        return $this->make(ModelFinder::class);
    }

    /**
     * Returns the main MezzoConfig instance
     *
     * @return MezzoConfig
     */
    public function config()
    {
        return $this->make(MezzoConfig::class);
    }

    /**
     * Gives you access to the Path helper singleton
     *
     * @return Path
     */
    public function path()
    {
        return app()->make('mezzo.path');
    }

    /**
     * Returns an instance of the illuminate view factory.
     *
     * @return \Illuminate\View\Factory
     */
    public function makeViewFactory()
    {
        return app(\Illuminate\Contracts\View\Factory::class);
    }
} 