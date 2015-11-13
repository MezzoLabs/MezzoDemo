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
        if (!$collection)
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
     * @param  callable $callback
     * @return $this
     */
    public function each(callable $callback)
    {
        return $this->collection()->each($callback);
    }

    /**
     * Run a filter over each of the items.
     *
     * @param  callable|null $callback
     * @return static
     */
    public function filter(callable $callback = null)
    {
        return new static($this->collection()->filter($callback));
    }

    /**
     * Run a map over each of the items.
     *
     * @param  callable $callback
     * @return static
     */
    public function map(callable $callback)
    {
        return new static($this->collection()->map($callback));
    }

    /**
     * Put an item in the collection by key.
     *
     * @param  mixed $key
     * @param  mixed $value
     * @return $this
     */
    public function put($key, $value)
    {
        $this->collection()->put($key, $value);
    }

    /**
     * Push an item onto the end of the collection.
     *
     * @param  mixed $value
     * @return $this
     */
    public function push($value)
    {
        return $this->collection()->push($value);
    }

    /**
     * Synonym for push.
     *
     * @param  mixed $value
     * @return $this
     */
    public function add($value)
    {
        return $this->push($value);
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

    /**
     * Get an item from the collection by key.
     *
     * @param  mixed $key
     * @param  mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->collection()->get($key, $default);
    }

    /**
     * Get the items in the collection that are not present in the given items.
     *
     * @param  mixed $items
     * @return static
     */
    public function diff($items)
    {
        return $this->collection()->diff($items);
    }

    /**
     * Determine if an item exists in the collection by key.
     *
     * @param  mixed $key
     * @return bool
     */
    public function has($key)
    {
        return $this->collection()->has($key);
    }

    /**
     * Determine if an item exists in the collection.
     *
     * @param  mixed $key
     * @param  mixed $value
     * @return bool
     */
    public function contains($key, $value = null)
    {
        return $this->collection()->contains($key, $value);
    }
}