<?php


namespace Mezzolabs\Mezzo\Cockpit\Html\Rendering\Handlers;

use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputMultiple;
use MezzoLabs\Mezzo\Core\Schema\Rendering\AttributeRenderingHandler;

class RelationAttributeMultipleRenderer extends AttributeRenderingHandler
{

    /**
     * Checks if this handler is responsible for rendering this kind of input.
     *
     * @param InputType $inputType
     * @return boolean
     */
    public function handles(InputType $inputType)
    {
        return $inputType instanceof RelationInputMultiple;
    }

    /**
     * Render the attribute to HTML.
     *
     * @param array $options
     * @return string
     * @throws \MezzoLabs\Mezzo\Core\Schema\Rendering\AttributeRenderingException
     */
    public function render(array $options = [])
    {
        $list = $this->makeEloquentList(false);

        $attributes = $this->htmlAttributes();
        $attributes['data-mezzo-select2'] = 1;

        return $this->formBuilder()->select(
            $this->name(),
            $list,
            $this->value(),
            $attributes
        );
    }


}