<?php

namespace MezzoLabs\Mezzo\Modules\Contents\Contracts;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;

interface ContentFieldTypeContract
{

    /**
     * A name that is unique for the parent content block.
     *
     * @return string
     */
    public function name();

    /**
     * Returns the input type of this content field.
     *
     * @return InputType
     */
    public function inputType();

    /**
     * Returns a collection of options that will determine the look and rules of this
     * Content field type.
     *
     * @return Collection
     */
    public function options();

    /**
     * Check if this field has to be filled out before a block can be saved.
     *
     * @return boolean
     */
    public function isRequired();
}