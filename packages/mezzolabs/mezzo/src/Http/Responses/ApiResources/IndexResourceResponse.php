<?php

namespace Mezzolabs\Mezzo\Http\Responses\ApiResources;


use MezzoLabs\Mezzo\Http\Requests\Queries\QueryObject;
use MezzoLabs\Mezzo\Http\Responses\ApiResources\Types\IndexResponse;

class IndexResourceResponse extends ResourceResponse implements IndexResponse
{
    /**
     * @var QueryObject
     */
    protected $query;


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



    public function beforeResponse()
    {
        event('mezzo.api.indexing: ' . $this->modelReflection()->className(), [$this]);
    }

    public function afterResponse()
    {
        event('mezzo.api.indexed: ' . $this->modelReflection()->className(), [$this]);
    }

    /**
     * @return QueryObject
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param QueryObject $query
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }

}