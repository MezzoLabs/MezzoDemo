<?php


namespace MezzoLabs\Mezzo\Modules\FileManager;


use App\File;
use App\ImageFile;
use App\Tutorial;
use App\User;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Modules\FileManager\Content\Blocks\ImageAndText;
use MezzoLabs\Mezzo\Modules\FileManager\Disk\DiskSynchronization;
use MezzoLabs\Mezzo\Modules\FileManager\Disk\FileUploader;
use MezzoLabs\Mezzo\Modules\FileManager\Domain\Observers\FileObserver;
use MezzoLabs\Mezzo\Modules\FileManager\Domain\TypedFiles\FileTypesMapper;
use MezzoLabs\Mezzo\Modules\FileManager\Http\Transformers\FileTransFormer;
use MezzoLabs\Mezzo\Modules\FileManager\Schema\Rendering\FileAttributeRenderer;
use MezzoLabs\Mezzo\Modules\FileManager\Schema\Rendering\FilesAttributeRenderer;
use MezzoLabs\Mezzo\Modules\FileManager\Schema\Rendering\FileTypes\ImageAttributeRenderer;
use MezzoLabs\Mezzo\Modules\FileManager\Schema\Rendering\FileTypes\ImageGalleryAttributeRenderer;

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
    }


    /**
     * Called when module is ready, model reflections are loaded.
     *
     * @return mixed
     */
    public function ready()
    {
        File::observe(FileObserver::class);

        $this->loadViews();

        $this->registerTransformers([
            File::class => FileTransFormer::class
        ]);

        $this->registerContentBlocks([
            ImageAndText::class
        ]);

        $this->registerAttributeRenderer([
            FileAttributeRenderer::class,
            FilesAttributeRenderer::class
        ]);

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