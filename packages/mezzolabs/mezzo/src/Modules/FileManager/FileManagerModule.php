<?php


namespace MezzoLabs\Mezzo\Modules\FileManager;


use App\File;
use App\Tutorial;
use App\User;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;

class FileManagerModule extends ModuleProvider
{

    protected $models = [
        File::class
    ];

    protected $options = [
        'icon' => 'ion-file'
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
        $tutorialReflection = $this->modelReflectionSets->get(Tutorial::class);

        //dd($tutorialReflection->relationships());
    }
}