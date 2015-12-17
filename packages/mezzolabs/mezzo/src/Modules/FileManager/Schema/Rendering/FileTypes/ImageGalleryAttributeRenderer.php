<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Schema\Rendering\FileTypes;


use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;
use MezzoLabs\Mezzo\Modules\FileManager\Schema\InputTypes\GalleryInput;
use MezzoLabs\Mezzo\Modules\FileManager\Schema\Rendering\FilesAttributeRenderer;

class ImageGalleryAttributeRenderer extends FilesAttributeRenderer
{
    /**
     * Checks if this handler is responsible for rendering this kind of input.
     *
     * @param InputType $inputType
     * @return boolean
     */
    public function handles(InputType $inputType)
    {
        return $inputType instanceof GalleryInput;
    }

    /**
     * Render the attribute to HTML.
     *
     * @return string
     */
    public function render()
    {
        return "gallery";
    }

}