<?php


namespace MezzoLabs\Mezzo\Cockpit\Html\Rendering;


use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Models\MezzoEloquentCollection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\AtomicAttribute;
use MezzoLabs\Mezzo\Core\Schema\Attributes\RelationAttribute;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputSingle;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\SimpleInput;
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

        return "!! Cannot render " . get_class($this->inputType());
    }

    /**
     * @param AtomicAttribute $attribute
     * @return string
     */
    protected function renderSimpleInput(AtomicAttribute $attribute)
    {
        $inputType = $attribute->type()->htmlType();
        return $this->formBuilder()->input($inputType, $attribute->name(), null, $this->htmlAttributes());
    }

    /**
     * @param RelationAttribute $attribute
     * @return string
     */
    protected function renderRelationInputSingle(RelationAttribute $attribute)
    {
        $collection = new MezzoEloquentCollection($attribute->otherModelReflection()->all());
        $list = $collection->asList()->merge([null=>'Please Select']);
        return $this->formBuilder()->select($attribute->name(),  $list, null, $this->htmlAttributes());
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


}