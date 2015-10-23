<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Http\Api;

use Dingo\Api\Http\Request as DingoRequest;
use Illuminate\Http\Request as IlluminateRequest;


class ApiRequest extends DingoRequest
{
    public function createFromIlluminate(IlluminateRequest $old)
    {
        parent::createFromIlluminate($old);
    }
}