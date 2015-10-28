<?php


namespace MezzoLabs\Mezzo\Cockpit\Html\Rendering;


use MezzoLabs\Mezzo\Core\Schema\Rendering\AttributeRenderer as AttributeSchemaRenderer;

class AttributeRenderer extends AttributeSchemaRenderer
{

    /**
     * Generate the HTML for the attribute schema.
     *
     * @return mixed
     */
    public function render()
    {
        return '<input type="password" name="rendertest" />';
    }
}