<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Disk\Publishers;

use Intervention\Image\Image as InterventionImage;
use Intervention\Image\ImageManager;
use MezzoLabs\Mezzo\Modules\FileManager\Disk\Systems\DiskSystemContract;
use MezzoLabs\Mezzo\Modules\FileManager\Disk\Systems\LocalDisk;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class LocalFilePublisher extends AbstractFilePublisher implements FilePublisherContract
{
    protected $imageSizes = [
        'small' => [300, 300],
        'medium' => [750, 750],
        'large' => [1920, 1080],
        'full' => [3500, 3500]
    ];

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
        $intervention = new ImageManager(array('driver' => 'gd'));

        $imageSizes = $this->imageSizes();

        $uniqueImageKey = $this->uniqueImageKey($file, $imageSizes[0], $imageSizes[1]);

        if (!file_exists($this->imageCacheFolder() . '/' . $uniqueImageKey)) {
            $image = $intervention
                ->make($file->absolutePath())
                ->resize($imageSizes[0], $imageSizes[1], function ($constraint) {
                    $constraint->aspectRatio();
                });

            $this->cacheImage($uniqueImageKey, $image);

            return $image->response();
        }

        return $intervention->make($this->imageCacheFolder() . '/' . $uniqueImageKey)->response();
    }

    protected function cacheImage($uniqueKey, InterventionImage $file)
    {
        $file->save($this->imageCacheFolder() . '/' . $uniqueKey);
    }

    protected function imageCacheFolder()
    {
        return storage_path() . '/mezzo/cache/images';
    }

    /**
     * @return mixed
     */
    protected function imageSizes()
    {
        $sizeKey = $this->imageSizeKey();

        if (!isset($this->imageSizes[$sizeKey]))
            throw new BadRequestHttpException('Image size is not supported.');

        return $this->imageSizes[$sizeKey];
    }

    protected function uniqueImageKey(\App\File $file, $width, $height)
    {
        return 'mezzo_image_' . $file->id . '-' . $width . 'x' . $height;
    }
}