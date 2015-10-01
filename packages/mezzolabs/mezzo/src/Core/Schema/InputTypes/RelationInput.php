<?php


namespace MezzoLabs\Mezzo\Core\Schema\InputTypes;


use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\Type;

abstract class RelationInput extends InputType{
    protected $doctrineType = Type::INTEGER;

} 