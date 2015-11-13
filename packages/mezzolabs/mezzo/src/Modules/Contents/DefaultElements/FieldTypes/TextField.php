<?php


namespace MezzoLabs\Mezzo\Modules\Contents\DefaultElements\FieldTypes;


use MezzoLabs\Mezzo\Core\Schema\InputTypes\TextInput;
use MezzoLabs\Mezzo\Modules\Contents\FieldTypes\AbstractContentFieldType;

class TextField extends AbstractContentFieldType
{
    protected $inputType = TextInput::class;

}