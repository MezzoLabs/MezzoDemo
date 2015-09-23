<?php

namespace MezzoLabs\Mezzo\Core\Schema\Converters;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Fluent\FluentAttribute;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;
use MezzoLabs\Mezzo\Core\Database\DatabaseColumn;
use MezzoLabs\Mezzo\Core\Schema\Attributes\AtomicAttribute;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes;
use MezzoLabs\Mezzo\Core\Schema\Attributes\RelationAttribute;
use MezzoLabs\Mezzo\Core\Schema\Columns\ConnectingColumn;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;
use MezzoLabs\Mezzo\Core\Schema\Relations\Relation;
use MezzoLabs\Mezzo\Core\Schema\Relations\RelationSide;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;

class AttributeConverter extends Converter
{

    public function run($toConvert)
    {
        if ($toConvert instanceof DatabaseColumn)
            return $this->fromDatabaseColumn($toConvert);

        if ($toConvert instanceof ConnectingColumn)
            return $this->fromConnectingColumn($toConvert);

        throw new InvalidArgumentException($toConvert);
    }

    /**
     * @param DatabaseColumn $databaseColumn
     * @return AtomicAttribute|RelationAttribute
     */
    public function fromDatabaseColumn(DatabaseColumn $databaseColumn)
    {
        $fluentAttribute = new FluentAttribute();

        if ($databaseColumn->isForeignKey()) {
            $fluentAttribute
                ->connectingColumn($databaseColumn->connectingColumn());
        } else {
            $fluentAttribute
                ->name($databaseColumn->name())
                ->type($databaseColumn->type())
                ->table($databaseColumn->table()->name());
        }

        $attribute = $fluentAttribute->make();


        return $attribute;

    }

    /**
     * @param ConnectingColumn $column
     * @return AtomicAttribute|RelationAttribute
     */
    public function fromConnectingColumn(ConnectingColumn $column)
    {
        $fluentAttribute = (new FluentAttribute())->connectingColumn($column);

        return $fluentAttribute->make();
    }


}