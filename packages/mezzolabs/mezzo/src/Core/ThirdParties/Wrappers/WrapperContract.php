<?php


namespace MezzoLabs\Mezzo\Core\ThirdParties\Wrappers;


interface WrapperContract {

    /**
     * Register a third party package.
     *
     * @return
     */
    public function register();

    /**
     * Prepare the configuration before a new service gets registered
     *
     * @return mixed
     */
    public function prepareConfig();
} 