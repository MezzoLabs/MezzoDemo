<?php


namespace MezzoLabs\Mezzo\Core\Collection;

use Illuminate\Support\Collection as IlluminateCollection;

abstract class DecoratedCollection
{
    /**
     * @var IlluminateCollection
     */
    protected $collection;

    public function __construct(IlluminateCollection $collection = null)
    {
        if(!$collection)
            $collection = new IlluminateCollection();

        $this->collection = $collection;
    }

    /**
     * @return IlluminateCollection
     */
    public function collection()
    {
        return $this->collection;
    }


    /**
     * Execute a callback over each item.
     *
     * @param  callable  $callback
     * @return $this
     */
    public function each(callable $callback)
    {
       return $this->collection()->each($callback);
    }

    /**
     * Run a filter over each of the items.
     *
     * @param  callable|null  $callback
     * @return static
     */
    public function filter(callable $callback = null)
    {
        return new static($this->collection()->filter($callback));
    }

    /**
     * Put an item in the collection by key.
     *
     * @param  mixed  $key
     * @param  mixed  $value
     * @return $this
     */
    public function put($key, $value)
    {
        $this->collection()->put($key, $value);
    }

    /**
     * Get the collection of items as a plain array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->collection()->toArray();
    }
}