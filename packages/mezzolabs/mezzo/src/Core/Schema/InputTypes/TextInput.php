<?php
namespace MezzoLabs\Mezzo\Core\Schema\InputTypes;

use Doctrine\DBAL\Types\StringType;

class TextInput extends SimpleInput
{
    protected $doctrineType = StringType::class;

    protected $htmlTag = "input:text";
}