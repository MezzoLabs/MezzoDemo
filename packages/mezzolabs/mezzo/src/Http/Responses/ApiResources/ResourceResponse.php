<?php

namespace Mezzolabs\Mezzo\Http\Responses\ApiResources;


use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;
use MezzoLabs\Mezzo\Http\Responses\ApiResponseFactory;
use MezzoLabs\Mezzo\Http\Transformers\EloquentModelTransformer;

abstract class ResourceResponse
{
    /**
     * @var ModelRepository
     */
    protected $repository;

    private function __construct()
    {

    }

    /**
     * @return ApiResponseFactory
     */
    protected function response()
    {
        return mezzo()->make(ApiResponseFactory::class);
    }

    protected function bestModelTransformer()
    {
        return EloquentModelTransformer::makeBest($this->modelReflection()->className());
    }

    /**
     * @return \MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection
     */
    public function modelReflection()
    {
        return $this->repository->modelReflection();
    }

    public function repository()
    {
        return $this->repository();
    }

    public function beforeResponse()
    {
        event('mezzo.api.generic.before: ' . $this->modelReflection()->className(), [$this]);
    }

    public function afterResponse()
    {
        event('mezzo.api.generic.after: ' . $this->modelReflection()->className(), [$this]);
    }

}