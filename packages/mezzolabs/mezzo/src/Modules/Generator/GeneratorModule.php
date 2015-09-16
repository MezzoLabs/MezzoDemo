<?php


namespace MezzoLabs\Mezzo\Modules\Generator;


use App\Tutorial;
use App\User;
use Illuminate\Support\Facades\App;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\Reflector;

class GeneratorModule extends ModuleProvider{
    protected $isCoreModule = true;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViews();

    }
    
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