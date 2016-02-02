<?php

namespace Mezzolabs\Mezzo\Http\Responses\ApiResources;

use MezzoLabs\Mezzo\Http\Responses\ApiResources\Types\IndexResponse;

class IndexRelationResponse extends ResourceResponse implements IndexResponse
{


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