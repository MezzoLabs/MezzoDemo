<?php

namespace Mezzolabs\Mezzo\Http\Responses\ApiResources;


use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;
use MezzoLabs\Mezzo\Http\Controllers\ApiResourceController;
use MezzoLabs\Mezzo\Http\Requests\Queries\QueryObject;
use MezzoLabs\Mezzo\Http\Requests\Resource\IndexResourceRequest;

class IndexResourceResponse extends ResourceResponse
{
    /**
     * @var QueryObject
     */
    protected $query;

    /**
     * IndexResourceResponse constructor.
     * @param QueryObject $query
     * @param ModelRepository $repository
     */
    public function __construct(QueryObject $query, ModelRepository $repository)
    {
        $this->query = $query;
        $this->repository = $repository;
    }

    public function get()
    {
        $this->beforeResponse();

        $response = $this->response()->collection($this->models(), $this->bestModelTransformer());

        if ($this->hasPagination()) {
            $response->withHeader('X-Total-Count', $this->repository()->count($this->query));
        }

        $this->afterResponse();

        return $response;
    }

    public function hasPagination()
    {
        return !$this->query->pagination()->isEmpty();
    }

    public function models($columns = ['*'])
    {
        return $this->repository->all($columns, $this->query);
    }

    /**
     * @return QueryObject
     */
    public function query()
    {
        return $this->query;
    }

    public function beforeResponse()
    {
        event('mezzo.api.indexing: ' . $this->modelReflection()->className(), [$this]);
    }

    public function afterResponse()
    {
        event('mezzo.api.indexed: ' . $this->modelReflection()->className(), [$this]);
    }

}