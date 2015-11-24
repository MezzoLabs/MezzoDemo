<?php


namespace Mezzolabs\Mezzo\Cockpit\Html\Rendering\Handlers;

use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\SimpleInput;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\TextArea;
use MezzoLabs\Mezzo\Core\Schema\Rendering\AttributeRenderingHandler;

class SimpleInputRenderer extends AttributeRenderingHandler
{

    /**
     * Checks if this handler is responsible for rendering this kind of input.
     *
     * @param InputType $inputType
     * @return boolean
     */
    public function handles(InputType $inputType)
    {
        return $inputType instanceof SimpleInput;
    }

    /**
     * Render the attribute to HTML.
     *
     * @return string
     */
    public function render()
    {
        $attribute = $this->attribute();
        $htmlType = $attribute->type()->htmlType();

        if ($attribute->type() instanceof TextArea)
            return $this->renderTextArea();

        return $this->formBuilder()->input($htmlType, $attribute->name(), old($attribute->name()), $this->htmlAttributes());
    }

    /**
     * @return string
     */
    protected function renderTextArea()
    {
        $htmlAttributes = $this->htmlAttributes();
        $htmlAttributes['rows'] = 4;

        return $this->formBuilder()->textarea($this->name(), $this->old(), $htmlAttributes);
    }


}