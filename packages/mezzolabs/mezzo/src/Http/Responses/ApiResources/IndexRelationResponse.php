<?php

namespace Mezzolabs\Mezzo\Http\Responses\ApiResources;


use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;
use MezzoLabs\Mezzo\Core\Schema\Attributes\RelationAttribute;
use MezzoLabs\Mezzo\Http\Requests\Queries\QueryObject;

class IndexRelationResponse extends ResourceResponse
{
    /**
     * IndexResourceResponse constructor.
     * @param QueryObject $query
     * @param ModelRepository $repository
     */
    public function __construct()
    {
        $this->indexResourceResponse = new IndexResourceResponse($query, $repository);
    }

    public function models($columns = ['*'])
    {
        return $this->repository->relationshipItems($columns, $this->query);
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