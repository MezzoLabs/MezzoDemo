<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Disk\Publishers;

use Intervention\Image\Image as InterventionImage;
use Intervention\Image\ImageManager;
use MezzoLabs\Mezzo\Modules\FileManager\Disk\Systems\DiskSystemContract;
use MezzoLabs\Mezzo\Modules\FileManager\Disk\Systems\LocalDisk;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class LocalFilePublisher extends AbstractFilePublisher implements FilePublisherContract
{


    /**
     * @var ImageManager
     */
    protected $intervention;

    public function __construct(\App\File $file, array $options)
    {
        parent::__construct($file, $options);

        $this->intervention = new ImageManager(array('driver' => 'gd'));
    }

    /**
     * The underlying file disk system.
     *
     * @return DiskSystemContract
     */
    public function system() : DiskSystemContract
    {
        return app(LocalDisk::class);
    }

    /**
     * @return bool
     */
    public function publish()
    {
        if ($this->file->fileType()->isImage() && !$this->forceDownload())
            return $this->publishImage($this->file);

        return $this->response()->download($this->file->sourcePath());
    }

    /**
     * @param \App\File $file
     * @return mixed
     */
    protected function publishImage(\App\File $file)
    {
        $imageSizes = $this->imageSizes();

        $uniqueImageKey = $this->uniqueImageKey($file, $imageSizes[0], $imageSizes[1]);

        if (!file_exists($this->imageCacheFolder() . '/' . $uniqueImageKey)) {
            $fit = $this->imageSizeKey() === "thumb";
            $image = $this->resize($file->absolutePath(), $imageSizes[0], $imageSizes[1], $fit);

            $this->cacheImage($uniqueImageKey, $image);


            return $image->response();
        }

        return $this->intervention->make($this->imageCacheFolder() . '/' . $uniqueImageKey)->response();
    }

    protected function resize($path, $width, $height, $fit = false)
    {
        if ($fit) {
            return $this->intervention
                ->make($path)
                ->fit($width, $height);
        }

        return $this->intervention
            ->make($path)
            ->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
     }

    protected function cacheImage($uniqueKey, InterventionImage $file)
    {
        $file->save($this->imageCacheFolder() . '/' . $uniqueKey);
    }

    protected function imageCacheFolder()
    {
        return storage_path() . '/mezzo/cache/images';
    }



    protected function uniqueImageKey(\App\File $file, $width, $height)
    {
        return 'mezzo_image_' . $file->id . '-' . $width . 'x' . $height;
    }
}