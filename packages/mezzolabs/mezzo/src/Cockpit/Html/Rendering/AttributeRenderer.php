<?php


namespace MezzoLabs\Mezzo\Cockpit\Html\Rendering;


use Illuminate\Support\Collection;
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
            return $this->renderSimpleInput();

        return "!! Cannot render " . get_class($this->inputType());
    }

    protected function renderSimpleInput()
    {
        $inputType = $this->attribute()->type()->htmlType();
        return $this->formBuilder()->input($inputType, $this->attribute()->name(), null, $this->htmlAttributes());
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
    public function validationAttributes()
    {
        return (new AngularAttributeValidation($this->attribute()))->htmlAttributes();
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

        return $attributes->toArray();
    }
}