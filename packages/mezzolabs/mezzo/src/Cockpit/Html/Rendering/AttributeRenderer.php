<?php


namespace MezzoLabs\Mezzo\Cockpit\Html\Rendering;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\AtomicAttribute;
use MezzoLabs\Mezzo\Core\Schema\Attributes\RelationAttribute;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputMultiple;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputSingle;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\SimpleInput;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\TextArea;
use MezzoLabs\Mezzo\Core\Schema\Rendering\AttributeRenderer as AttributeSchemaRenderer;

class AttributeRenderer extends AttributeSchemaRenderer
{

    protected $cssClass = 'form-control';

    /**
     * Generate the HTML for the attribute schema.
     *
     * @return mixed
     */
    public function render()
    {
        if($this->inputType() instanceof SimpleInput)
            return $this->renderSimpleInput($this->attribute());

        if($this->inputType() instanceof RelationInputSingle)
            return $this->renderRelationInputSingle($this->attribute());

        if($this->inputType() instanceof RelationInputMultiple)
            return $this->renderRelationInputMultiple($this->attribute());

        return "!! Cannot render " . get_class($this->inputType());
    }

    /**
     * @param AtomicAttribute $attribute
     * @return string
     */
    protected function renderSimpleInput(AtomicAttribute $attribute)
    {
        $htmlType = $attribute->type()->htmlType();

        if ($attribute->type() instanceof TextArea)
            return $this->renderTextArea($attribute);

        return $this->formBuilder()->input($htmlType, $attribute->name(), old($attribute->name()), $this->htmlAttributes());
    }

    /**
     * @param RelationAttribute $attribute
     * @return string
     */
    protected function renderRelationInputSingle(RelationAttribute $attribute)
    {
        $list = $this->makeEloquentList($attribute, true);
        return $this->formBuilder()->select($attribute->name(),  $list, old($attribute->name()), $this->htmlAttributes());
    }


    protected function renderRelationInputMultiple(RelationAttribute $attribute)
    {
        $list = $this->makeEloquentList($attribute, false);
        return $this->formBuilder()->select($attribute->name(),  $list, old($attribute->name()), $this->htmlAttributes());
    }

    /**
     * Create a list for a select box.
     *
     * @param RelationAttribute $attribute
     * @param bool $addPleaseSelect
     * @return static
     */
    protected function makeEloquentList(RelationAttribute $attribute, $addPleaseSelect = true){
        $collection = $attribute->otherModelReflection()->all();

        $array = $collection->pluck('label', 'id')->toArray();

        if(!$addPleaseSelect)
            return $array;

        $array[null] = 'Please Select';

        return $array;
    }

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
     * @return Collection
     */
    protected function validationAttributes()
    {
        return (new AttributeHtmlValidation($this->attribute()))->htmlAttributes();
    }

    protected function relationAttributes(RelationAttribute $attribute)
    {
        $attributes = new Collection();

        $attributes->put('data-model', $attribute->otherRelationSide()->modelReflection()->name());
        $attributes->put('data-relation', $attribute->relation()->shortType());

        $attributes->put('data-multiple', $attribute->hasMultipleChildren());

        if($attribute->hasMultipleChildren())
            $attributes->put('multiple', 'multiple');

        return $attributes;
    }

    /**
     * Create an array of html attributes for this attribute schema.
     *
     * @return array
     */
    protected function htmlAttributes()
    {
        $attributes = new Collection();

        $attributes->put('class', $this->cssClass);

        $attributes = $attributes->merge($this->validationAttributes());

        if($this->attribute->isRelationAttribute())
            $attributes = $attributes->merge($this->relationAttributes($this->attribute()));

        return $attributes->toArray();
    }

    /**
     * @param AtomicAttribute $attribute
     * @return string
     */
    protected function renderTextArea(AtomicAttribute $attribute)
    {
        $htmlAttributes = $this->htmlAttributes();
        $htmlAttributes['rows'] = 4;

        return $this->formBuilder()->textarea($attribute->name(), old($attribute->name()), $htmlAttributes);
    }


}