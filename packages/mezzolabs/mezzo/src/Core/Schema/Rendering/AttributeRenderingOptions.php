<?php


namespace MezzoLabs\Mezzo\Core\Schema\Rendering;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Collection\DecoratedCollection;

class AttributeRenderingOptions extends DecoratedCollection
{
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
    public function attributes()
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