<?php
namespace MezzoLabs\Mezzo\Core\Schema\InputTypes;

use Doctrine\DBAL\Types\FloatType;

class NumberInput extends SimpleInput
{
    protected $doctrineType = FloatType::class;

    protected $htmlTag = "input:number";
}