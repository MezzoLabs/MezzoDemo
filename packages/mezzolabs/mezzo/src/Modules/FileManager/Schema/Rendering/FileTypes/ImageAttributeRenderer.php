<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Schema\Rendering\FileTypes;


use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;
use MezzoLabs\Mezzo\Modules\FileManager\Schema\InputTypes\ImageInput;
use MezzoLabs\Mezzo\Modules\FileManager\Schema\Rendering\FileAttributeRenderer;

class ImageAttributeRenderer extends FileAttributeRenderer
{
    /**
     * Checks if this handler is responsible for rendering this kind of input.
     *
     * @param InputType $inputType
     * @return boolean
     */
    public function handles(InputType $inputType)
    {
        return $inputType instanceof ImageInput;
    }

    /**
     * Render the attribute to HTML.
     *
     * @return string
     */
    public function render()
    {
        return $this->view('modules.filemanager::partials.fileinput');
    }

}