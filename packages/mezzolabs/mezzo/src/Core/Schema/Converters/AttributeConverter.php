<?php

namespace MezzoLabs\Mezzo\Core\Schema\Converters;


use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;
use MezzoLabs\Mezzo\Core\Database\DatabaseColumn;
use MezzoLabs\Mezzo\Core\Schema\Attributes\AtomicAttribute;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes;
use MezzoLabs\Mezzo\Core\Schema\Attributes\RelationAttribute;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;
use MezzoLabs\Mezzo\Core\Schema\Relations\RelationSide;

class AttributeConverter extends Converter
{
    protected $store = array();

    public function fromDatabaseColumn(DatabaseColumn $column)
    {
        if ($column->isForeignKey()) {
            $attribute = new RelationAttribute(
                $column->name(),
                new RelationSide($column->connectingColumn()->relation(), $column->table()->name()),
                []
            );
        } else {
            $attribute = new AtomicAttribute(
                $column->name(), InputType::fromType($column->type()),
                []
            );
        }

        return $attribute;

    }


    public function run($toConvert)
    {
        if ($toConvert instanceof DatabaseColumn)
            return $this->fromDatabaseColumn($toConvert);
    }
}