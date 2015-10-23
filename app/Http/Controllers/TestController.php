<?php


namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use Dingo\Api\Routing\Helpers;
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


} 