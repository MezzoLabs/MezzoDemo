<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Http\Controllers;


use Intervention\Image\Image as InterventionImage;
use Intervention\Image\ImageManager;
use MezzoLabs\Mezzo\Http\Controllers\CockpitController;
use MezzoLabs\Mezzo\Modules\FileManager\Domain\Repositories\FileRepository;
use MezzoLabs\Mezzo\Modules\FileManager\Exceptions\PathPatternInvalidException;
use MezzoLabs\Mezzo\Modules\FileManager\Http\Requests\PublishFileRequest;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PublishFilesController extends CockpitController
{
    protected $pathRegex = '|((?:[a-zA-Z0-9\_\-]+\/)*)([a-zA-Z0-9\_\-]+)\.([a-z0-9]+)|';

    protected $imageSizes = [
        'small' => [300, 300],
        'medium' => [750, 750],
        'large' => [1920, 1080],
        'full' => [3500, 3500]
    ];

    /**
     * @var PublishFileRequest
     */
    protected $request;

    public function publish(PublishFileRequest $request, $path)
    {
        $parts = $this->matchPath($path);
        $forceDownload = ($request->get('download', 0) == 1);

        $this->request = $request;

        return $this->publishFileInFolder($parts['filename'], $parts['folder'], $forceDownload);
    }

    protected function matchPath($path)
    {
        $matches = array();
        preg_match($this->pathRegex, $path, $matches);

        if (count($matches) != 4 || !($matches[0] == $path))
            throw new PathPatternInvalidException();

        return [
            'folder' => $matches[1],
            'filename' => $matches[2] . '.' . $matches[3],
            'extension' => $matches[3]
        ];


    }

    /**
     * @param string $filename
     * @param string $folder
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    protected function publishFileInFolder($filename, $folder, $forceDownload = false)
    {
        $repo = $this->filesRepository();

        $file = $repo->findByFilenameAndFolder($filename, $folder);

        if (!$file)
            throw new NotFoundHttpException();

        if ($file->fileType()->isImage() && !$forceDownload)
            return $this->publishImage($file);

        return $this->response()->download($file->longPath());

    }

    /**
     * @return FileRepository
     * @throws \MezzoLabs\Mezzo\Exceptions\RepositoryException
     */
    protected function filesRepository()
    {
        return FileRepository::makeRepository();
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
                ->make($file->longPath())
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

    protected function uniqueImageKey(\App\File $file, $width, $height)
    {
        return 'mezzo_image_' . $file->id . '-' . $width . 'x' . $height;
    }

    /**
     * @return mixed
     */
    protected function imageSizes()
    {
        $sizeKey = $this->request->get('size', 'medium');

        if (!isset($this->imageSizes[$sizeKey]))
            throw new BadRequestHttpException('Image size is not supported.');

        return $this->imageSizes[$sizeKey];
    }
}