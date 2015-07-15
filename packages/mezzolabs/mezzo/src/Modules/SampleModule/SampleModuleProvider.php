<?php


namespace MezzoLabs\Mezzo\Modules\SampleModule;


use App\User;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;

class SampleModuleProvider extends ModuleProvider{

    protected $modules = [
        User::class
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }
}