<?php


namespace MezzoLabs\Mezzo\Core\ThirdParties\Wrappers;


interface WrapperInterface {

    /**
     * Register a third party package.
     *
     * @return \Illuminate\Support\ServiceProvider
     */
    public function register();

    /**
     * Prepare the configuration before a new service gets registered
     *
     * @return mixed
     */
    public function prepareConfig();

    /**
     * Called when the package service provider got booted. (We listened carefully)
     *
     * @return mixed
     */
    public function onProviderBooted();

} 