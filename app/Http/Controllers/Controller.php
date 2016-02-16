<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\UnauthorizedException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use MezzoLabs\Mezzo\Http\Controllers\Controller as MezzoBaseController;

abstract class Controller extends MezzoBaseController
{
    use DispatchesJobs, ValidatesRequests, AuthorizesRequests;

    public function userOrFail() : \App\User
    {
        $user = \Auth::user();

        if (!$user) {
            throw new UnauthorizedException('You have to be logged in to view this page.');
        }

        return $user;
    }
}
