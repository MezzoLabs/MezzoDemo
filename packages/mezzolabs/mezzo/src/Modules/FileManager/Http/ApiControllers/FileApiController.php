<?php

namespace MezzoLabs\Mezzo\Modules\FileManager\Http\ApiControllers;


use MezzoLabs\Mezzo\Core\Configuration\MezzoConfig;
use MezzoLabs\Mezzo\Http\Controllers\GenericApiResourceController;
use MezzoLabs\Mezzo\Modules\FileManager\Disk\Exceptions\FileUploadException;
use MezzoLabs\Mezzo\Modules\FileManager\Disk\FileUploadManager;
use MezzoLabs\Mezzo\Modules\FileManager\Http\Requests\UploadFileRequest;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class FileApiController extends GenericApiResourceController
{
    public function upload(UploadFileRequest $request)
    {
        try {
            $file = $this->uploader()->uploadInput($request, mezzo()->config('filemanager.active_disk'));

        } catch (FileUploadException $exception) {
            throw new BadRequestHttpException($exception->getMessage());
        }

        return $this->response()->item($file, $this->bestModelTransformer());
    }

    /**
     * @return FileUploadManager
     */
    protected function uploader()
    {
        return app()->make(FileUploadManager::class);
    }
}