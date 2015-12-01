<?php


namespace MezzoLabs\Mezzo\Modules\Contents\Schema\Rendering;


use Mezzolabs\Mezzo\Cockpit\Html\Rendering\Handlers\RelationInputSingleRenderer;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;
use MezzoLabs\Mezzo\Modules\Contents\Schema\InputTypes\ContentInput;

class ContentInputRenderer extends RelationInputSingleRenderer
{

    /**
     * Checks if this handler is responsible for rendering this kind of input.
     *
     * @param InputType $inputType
     * @return boolean
     */
    public function handles(InputType $inputType)
    {
        return $inputType instanceof ContentInput;
    }

    /**
     * Render the attribute to HTML.
     *
     * @return string
     */
    public function render()
    {
        return $this->view('modules.contents::block_type_select', ['content' => $this->content()]);
    }

    public function content()
    {
        return $this->valueOfAttribute('content');
    }
}