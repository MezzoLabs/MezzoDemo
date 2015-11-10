<?php

namespace MezzoLabs\Mezzo\Modules\FileManager\Http\ApiControllers;


use MezzoLabs\Mezzo\Http\Controllers\ApiResourceController;
use MezzoLabs\Mezzo\Modules\FileManager\Disk\Exceptions\FileUploadException;
use MezzoLabs\Mezzo\Modules\FileManager\Disk\FileUploader;
use MezzoLabs\Mezzo\Modules\FileManager\Http\Requests\UploadFileRequest;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class FileApiController extends ApiResourceController
{
    public function upload(UploadFileRequest $request)
    {
        try {
            $uploaded = $this->uploader()->uploadInput($request);

        } catch (FileUploadException $exception) {
            throw new BadRequestHttpException($exception->getMessage());
        }

        if (!$uploaded)
            throw new BadRequestHttpException('File upload failed unexpected.');

        return $this->response()->result(1);
    }

    /**
     * @return FileUploader
     */
    protected function uploader()
    {
        return app()->make(FileUploader::class);
    }
}