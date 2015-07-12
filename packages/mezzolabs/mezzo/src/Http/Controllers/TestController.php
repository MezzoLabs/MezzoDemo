<?php


namespace MezzoLabs\Mezzo\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class TestController extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    public function test()
    {
        dd('die');
    }
} 