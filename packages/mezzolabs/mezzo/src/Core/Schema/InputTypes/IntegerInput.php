<?php
namespace MezzoLabs\Mezzo\Core\Schema\InputTypes;

use Doctrine\DBAL\Types\IntegerType;

class IntegerInput extends NumberInput
{
    protected $doctrineType = IntegerType::class;
}