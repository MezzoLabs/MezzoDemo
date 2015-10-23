<?php


namespace MezzoLabs\Mezzo\Http\Requests;

use Dingo\Api\Http\Request as DingoRequest;
use Illuminate\Http\Request as IlluminateRequest;


class ApiRequest extends DingoRequest
{
    public function createFromIlluminate(IlluminateRequest $old)
    {
        DingoRequest::createFromIlluminate($old);
    }

    /**
     * @return ApiRequest
     */
    public static function make()
    {
        return mezzo()->make(ApiRequest::class);
    }
}