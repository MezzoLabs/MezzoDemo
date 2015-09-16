<?php


namespace MezzoLabs\Mezzo\Modules\Sample;


use App\Tutorial;
use App\User;
use Illuminate\Support\Facades\App;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\Reflector;

class SampleModule extends ModuleProvider{

    protected $isCoreModule = true;

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

        $tutorialReflection = $this->modelReflections->get(Tutorial::class);
        //dd($tutorialReflection->relationships());
    }
}