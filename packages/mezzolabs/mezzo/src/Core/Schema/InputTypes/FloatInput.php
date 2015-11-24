<?php
namespace MezzoLabs\Mezzo\Core\Schema\InputTypes;

use Doctrine\DBAL\Types\Type;

class FloatInput extends NumberInput
{
    /**
     * @var string
     */
    protected $doctrineType = Type::FLOAT;

    protected $htmlTag = "input:float";


}