<?php


namespace MezzoLabs\Mezzo\Core\Schema\Rendering;


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
}