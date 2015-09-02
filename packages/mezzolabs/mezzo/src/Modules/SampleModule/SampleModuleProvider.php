<?php


namespace MezzoLabs\Mezzo\Modules\SampleModule;


use App\Tutorial;
use App\User;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;

class SampleModuleProvider extends ModuleProvider{

    protected $modules = [
        User::class,
        Tutorial::class,
        'DoesNotExist'
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
     * Called when module is ready, model wrappers are loaded.
     *
     * @return mixed
     */
    public function ready()
    {
    }
}