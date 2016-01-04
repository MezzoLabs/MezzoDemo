<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use MezzoLabs\Mezzo\Http\Controllers\Controller as MezzoBaseController;

abstract class Controller extends MezzoBaseController
{
    use DispatchesJobs, ValidatesRequests, AuthorizesRequests;
}
