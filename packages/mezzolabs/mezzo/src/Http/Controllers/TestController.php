<?php


namespace MezzoLabs\Mezzo\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class TestController extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    public function test()
    {
        dd('die');
    }
} 