<?php


namespace MezzoLabs\Mezzo\Modules\Contents\DefaultElements\BlockTypes;


use MezzoLabs\Mezzo\Modules\Contents\BlockTypes\AbstractContentBlockType;
use MezzoLabs\Mezzo\Modules\Contents\DefaultElements\FieldTypes\TextField;

class TextOnly extends AbstractContentBlockType
{

    /**
     * Called when a content block type is booted.
     * Now is the time to add some field types to this type of content block.
     */
    public function boot()
    {
        $this->addField(new TextField('text'));
    }
}