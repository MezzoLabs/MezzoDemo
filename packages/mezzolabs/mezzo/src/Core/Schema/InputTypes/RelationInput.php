<?php


namespace MezzoLabs\Mezzo\Core\Schema\InputTypes;


use Doctrine\DBAL\Types\IntegerType;

abstract class RelationInput extends InputType{
    protected $doctrineType = IntegerType::class;

} 