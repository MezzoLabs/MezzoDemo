<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Http\Requests;


use App\File;
use MezzoLabs\Mezzo\Http\Requests\Resource\CreateResourceRequest;

class UploadFileRequest extends CreateResourceRequest
{
    public $model = File::class;


}