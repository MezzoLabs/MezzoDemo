<?php


namespace MezzoLabs\Mezzo\Modules\FileManager;


use App\File;
use App\ImageFile;
use App\Tutorial;
use App\User;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Modules\FileManager\Disk\DiskSynchronization;
use MezzoLabs\Mezzo\Modules\FileManager\Disk\FileUploader;
use MezzoLabs\Mezzo\Modules\FileManager\Domain\TypedFiles\FileTypesMapper;

#
class FileManagerModule extends ModuleProvider
{
    protected $models = [
        File::class,
        ImageFile::class
    ];

    protected $options = [
        'icon' => 'ion-ios-folder'
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->bindWithPrefix('fileuploader', FileUploader::class, true);
        $this->bindWithPrefix('typedfilemapper', FileTypesMapper::class, true);
        $this->bindWithPrefix('drivesnychronization', DiskSynchronization::class, true);

        $this->driveSynchronization()->setListeners();

    }

    /**
     * @return DiskSynchronization
     */
    public function driveSynchronization()
    {
        return app(DiskSynchronization::class);
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

    /**
     * @return FileTypesMapper
     */
    public function fileTypesMapper()
    {
        return app(FileTypesMapper::class);
    }


}