<?php


namespace MezzoLabs\Mezzo\Http\Requests\Queries;

use MezzoLabs\Mezzo\Core\Collection\StrictCollection;

class Filters extends StrictCollection
{
    /**
     * Check if a item can be part of this collection.
     *
     * @param $value
     * @return boolean
     */
    protected function checkItem($value)
    {
        return $value instanceof Filter;
    }
}