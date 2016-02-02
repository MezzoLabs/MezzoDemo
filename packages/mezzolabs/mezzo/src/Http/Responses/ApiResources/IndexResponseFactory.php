<?php

namespace Mezzolabs\Mezzo\Http\Responses\ApiResources;


use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;
use MezzoLabs\Mezzo\Http\Requests\Queries\QueryObject;

class IndexResponseFactory
{
    public static function relation()
    {

    }

    public static function resource(QueryObject $query, ModelRepository $repository)
    {
        $indexResourceResponse = new IndexResourceResponse();

        $indexResourceResponse->qu
    }
}