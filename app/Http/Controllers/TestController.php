<?php


namespace App\Http\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Validator;
use Mockery\CountValidator\Exception;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class TestController extends Controller{

    use Helpers;

    public function sayHi(){

        throw new ConflictHttpException('User was updated prior to your request.');
    }


} 