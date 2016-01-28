<?php


namespace MezzoLabs\Mezzo\Core\Schema\Rendering;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Collection\DecoratedCollection;

class AttributeRenderingOptions extends DecoratedCollection
{
    public function index()
    {
        if($this->has('index'))
            return $this->get('index');

        if($this->parent()->getOptions()->has('index')){
            return $this->parent()->getOptions()->get('index');
        }

        return 0;
    }

    public function arraySeperators()
    {

    }

    public function renderBefore()
    {
        return $this->get('wrap', true);
    }

    public function renderAfter()
    {
        return $this->get('wrap', true);
    }

    /**
     * Check if this attribute renders inside the form of a relation.
     *
     * @return bool
     */
    public function isNested()
    {
        return $this->has('parent');
    }

    /**
     * @return AttributeRenderingHandler
     */
    public function parent()
    {
        return $this->get('parent', null);
    }

    public function parentName()
    {
        $parent = $this->parent();

        if (!$parent)
            throw new AttributeRenderingException('There is no parent attribute.');

        return $parent->relationSide()->naming();

    }

    /**
     * @return array
     */
    public function attributes() : array
    {
        return $this->get('attributes', []);
    }

    public function getAttribute($key, $default = null)
    {
        $attributes = new Collection($this->attributes());

        return $attributes->get($key, $default);
    }

    public function hasAttribute($key)
    {
        $attributes = new Collection($this->attributes());

        return $attributes->has($key);
    }
}