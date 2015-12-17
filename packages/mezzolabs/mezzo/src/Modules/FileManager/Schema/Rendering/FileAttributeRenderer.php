<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Schema\Rendering;


use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;
use MezzoLabs\Mezzo\Core\Schema\Rendering\AttributeRenderingHandler;

class FileAttributeRenderer extends AttributeRenderingHandler
{
    /**
     * Checks if this handler is responsible for rendering this kind of input.
     *
     * @param InputType $inputType
     * @return boolean
     */
    public function handles(InputType $inputType)
    {
        return false;
    }

    /**
     * Render the attribute to HTML.
     *
     * @return string
     */
    public function render()
    {
        return $this->formBuilder()->filePicker($this->attribute());
    }

}