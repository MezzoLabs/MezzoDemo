<?php

namespace App\Http\Requests;

use Auth;
use MezzoLabs\Mezzo\Http\Requests\Resource\UpdateResourceRequest;

class UpdateUserRequest extends UpdateResourceRequest
{
    public $model = \App\User::class;

    public function getId()
    {
        return Auth::user()->id;
    }

}
