<?php

namespace MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories;


use MezzoLabs\Mezzo\Http\Requests\Queries\QueryObject;

interface SearcherContract
{
    public function run();

    public function setQueryObject(QueryObject $queryObject);

    public function getQueryObject() : QueryObject;
}