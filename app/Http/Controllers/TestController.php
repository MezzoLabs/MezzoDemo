<?php


namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use Dingo\Api\Routing\Helpers;
use MezzoLabs\Mezzo\Modules\FileManager\Disk\FileUploader;
use MezzoLabs\Mezzo\Modules\FileManager\Http\Requests\UpdateFileRequest;
use MezzoLabs\Mezzo\Modules\FileManager\Http\Requests\UploadFileRequest;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class TestController extends Controller
{

    use Helpers;

    public function sayHi()
    {

        throw new ConflictHttpException('User was updated prior to your request.');
    }


    public function welcome($id)
    {
        return view('welcome');
    }

    public function foo(TestRequest $request)
    {
        return "bar";
    }

    public function updateFile(UpdateFileRequest $request, $id)
    {
        $file = \App\File::find($id);
        $file->delete();
        /**
         *
         * $repo = FileRepository::makeRepository();
         * $repo->update($request->all(), $id);
         * **/

        return "update file";
    }

    /**
     * Uploads a file.
     *
     * @param UploadFileRequest $request
     */
    public function uploadFile(UploadFileRequest $request)
    {
        $uploader = new FileUploader();

        $uploader->uploadInput($request);
    }

    public function deleteFile(UploadFileRequest $request)
    {

    }


} 