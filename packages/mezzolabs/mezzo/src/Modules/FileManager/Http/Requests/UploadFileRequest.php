<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Http\Requests;


use App\File;
use MezzoLabs\Mezzo\Http\Requests\Resource\UpdateResourceRequest;

class UploadFileRequest extends UpdateResourceRequest
{
    public $model = File::class;


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

}