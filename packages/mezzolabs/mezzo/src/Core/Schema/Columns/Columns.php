<?php

namespace MezzoLabs\Mezzo\Core\Schema\Columns;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Relations\Relation;

class Columns extends Collection
{

    public function addColumn(Column $column)
    {
        return $this->put($column->qualifiedName(), $column);
    }

    public function addAtomicColumn($name, $type, $table)
    {
        return $this->addColumn(new AtomicColumn($name, $type, $table));
    }

    public function addConnectingColumn($name, $type, $table, Relation $relation)
    {
        return $this->addColumn(new ConnectingColumn($name, $type, $table, $relation));
    }

    public function connectingColumns()
    {
        return $this->filter(function (Column $column) {
            return $column instanceof ConnectingColumn;
        });
    }
} 