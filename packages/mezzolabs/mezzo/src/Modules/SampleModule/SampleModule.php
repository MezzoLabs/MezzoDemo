<?php


namespace MezzoLabs\Mezzo\Modules\SampleModule;


use App\Tutorial;
use App\User;
use Illuminate\Support\Facades\App;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\Reflector;

class SampleModule extends ModuleProvider{



    protected $models = [
        Tutorial::class,
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
        var_dump(app()->make('mezzo.reflector')->isBooted());

        $tutorialReflection = $this->modelReflections->get(Tutorial::class);

        var_dump(app()->make('mezzo.reflector')->isBooted());

    }
}