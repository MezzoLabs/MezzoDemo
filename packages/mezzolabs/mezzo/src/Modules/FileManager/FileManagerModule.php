<?php


namespace MezzoLabs\Mezzo\Modules\FileManager;


use App\File;
use App\Tutorial;
use App\User;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Modules\FileManager\FileUpload\FileUploader;

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
        $this->bindWithPrefix('fileuploader', FileUploader::class, true);
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

    /**
     * @return FileUploader
     */
    public function uploader()
    {
        return app(FileUploader::class);
    }
}