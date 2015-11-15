<?php


namespace MezzoLabs\Mezzo\Modules\Contents\DefaultElements\FieldTypes;


use MezzoLabs\Mezzo\Core\Schema\InputTypes\TextInput;
use MezzoLabs\Mezzo\Modules\Contents\Types\FieldTypes\AbstractContentFieldType;

class TextField extends AbstractContentFieldType
{
    protected $inputType = TextInput::class;

}