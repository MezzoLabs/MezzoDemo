<?php


namespace MezzoLabs\Mezzo\Modules\General;


use MezzoLabs\Mezzo\Core\Modularisation\Generic\GeneralModule as GenericGeneralModule;

class GeneralModule extends GenericGeneralModule
{

    protected $models = [];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {


    }

    /**
     * Called when module is ready, model reflections are loaded.
     *
     * @return mixed
     */
    public function ready()
    {
    }
}