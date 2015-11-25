<?php


namespace MezzoLabs\Mezzo\Cockpit\Html\Rendering;

use Illuminate\Support\Collection;
use Mezzolabs\Mezzo\Cockpit\Html\Rendering\Handlers\CategoriesInputRenderer;
use Mezzolabs\Mezzo\Cockpit\Html\Rendering\Handlers\RelationInputMultipleRenderer;
use Mezzolabs\Mezzo\Cockpit\Html\Rendering\Handlers\RelationInputSingleRenderer;
use Mezzolabs\Mezzo\Cockpit\Html\Rendering\Handlers\SimpleInputRenderer;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;
use MezzoLabs\Mezzo\Core\Schema\Attributes\RelationAttribute;
use MezzoLabs\Mezzo\Core\Schema\Rendering\AttributeRenderEngine as AbstractAttributeRenderEngine;

class AttributeRenderEngine extends AbstractAttributeRenderEngine
{
    public static $handlers = [
        CategoriesInputRenderer::class,
        RelationInputSingleRenderer::class,
        RelationInputMultipleRenderer::class,
        SimpleInputRenderer::class
    ];

    protected $cssClass = 'form-control';

    /**
     * @return FormBuilder
     */
    public function formBuilder()
    {
        return app(FormBuilder::class);
    }

    /**
     * Generate the attributes that angular can use for validation.
     *
     * @param Attribute $attribute
     * @return Collection
     */
    protected function validationAttributes(Attribute $attribute)
    {
        return (new AttributeHtmlValidation($attribute))->htmlAttributes();
    }

    protected function relationAttributes(RelationAttribute $attribute)
    {
        $attributes = new Collection();

        $attributes->put('data-model', $attribute->otherRelationSide()->modelReflection()->name());
        $attributes->put('data-relation', $attribute->relation()->shortType());

        $attributes->put('data-multiple', $attribute->hasMultipleChildren());

        if ($attribute->hasMultipleChildren())
            $attributes->put('multiple', 'multiple');

        return $attributes;
    }

    /**
     * Create an array of html attributes for this attribute schema.
     *
     * @param Attribute $attribute
     * @return array
     */
    public function htmlAttributes(Attribute $attribute)
    {
        $attributes = new Collection();

        $attributes->put('class', $this->cssClass);

        $attributes = $attributes->merge($this->validationAttributes($attribute));

        if ($attribute->isRelationAttribute())
            $attributes = $attributes->merge($this->relationAttributes($attribute));

        return $attributes->toArray();
    }


}