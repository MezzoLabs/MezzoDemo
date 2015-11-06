<?php


namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use Dingo\Api\Routing\Helpers;
use MezzoLabs\Mezzo\Modules\FileManager\Http\Requests\UpdateFileRequest;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class TestController extends Controller{

    use Helpers;

    public function sayHi(){

        throw new ConflictHttpException('User was updated prior to your request.');
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

        $repo = FileRepository::makeRepository();
        $repo->update($request->all(), $id);
         * **/

        return "update file";
    }


} 