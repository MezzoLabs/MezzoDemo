<?php


namespace MezzoLabs\Mezzo\Modules\SampleModule;


use App\Tutorial;
use App\User;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;

class Module extends ModuleProvider{



    protected $models = [
        Tutorial::class
    ];

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