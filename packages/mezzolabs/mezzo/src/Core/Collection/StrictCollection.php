<?php


namespace MezzoLabs\Mezzo\Core\Collection;

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
        return parent::put($key, $value);
    }

    /**
     * Push an item onto the end of the collection.
     *
     * @param  mixed $value
     * @return $this
     */
    public function push($value)
    {
        $this->assertThatItemIsValue($value);
        return parent::push($value);
    }


    protected function assertThatItemIsValue($value){
        if(!$this->checkItem($value))
            throw new InvalidArgumentException($value);

        return true;
    }

    /**
     * Check if a item can be part of this collection.
     *
     * @param $value
     * @return boolean
     */
    abstract protected function checkItem($value);

}