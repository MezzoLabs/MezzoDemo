<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Http\Api;


use Dingo\Api\Routing\Helpers as ApiHelpers;
use MezzoLabs\Mezzo\Core\Modularisation\Http\ModuleController;

abstract class ApiController extends ModuleController
{
    use ApiHelpers;

    /**
     * @var \Dingo\Api\Http\Response\Factory
     */
    protected $response;

    /**
     * @return \MezzoLabs\Mezzo\Core\Modularisation\Http\Html\ModuleRequest
     */
    protected function request()
    {
        return mezzo()->makeRequest();
    }

    /**
     * @return ApiResponseFactory
     */
    protected function response()
    {
        return mezzo()->make(ApiResponseFactory::class);
    }
}