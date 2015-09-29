<?php


namespace MezzoLabs\Mezzo\Modules\Generator;


use App\Tutorial;
use App\User;
use Illuminate\Support\Facades\App;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\Reflector;
use MezzoLabs\Mezzo\Modules\Generator\Commands\GenerateForeignFields;
use MezzoLabs\Mezzo\Modules\Generator\GeneratorCenter;

class GeneratorModule extends ModuleProvider{

    protected $commands = [
        GenerateForeignFields::class
    ];



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
        $this->bind('center', GeneratorCenter::class);
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