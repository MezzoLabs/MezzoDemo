<?php


namespace MezzoLabs\Mezzo\Core\Collection;

use Illuminate\Support\Collection as IlluminateCollection;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;

abstract class StrictCollection extends DecoratedCollection
{
    /**
     * Put an item in the collection by key.
     *
     * @param  mixed  $key
     * @param  mixed  $value
     * @return $this
     */
    public function put($key, $value)
    {
        $this->assertThatItemIsValue($value);

        $this->collection()->put($key, $value);
    }

    protected function assertThatItemIsValue($value){
        if(!$this->checkItem($value))
            throw new InvalidArgumentException($value);

        return true;
    }

    abstract protected function checkItem($value);

}