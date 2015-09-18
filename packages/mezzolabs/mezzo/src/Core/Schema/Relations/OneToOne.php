<?php

namespace MezzoLabs\Mezzo\Core\Schema\Relations;


class OneToOne extends Relation{

    /**
     * Set up the connection from one table to another.
     *
     * @param string $tableName
     * @param string $columnName
     */
    function connectVia($columnName, $tableName = false){
        $this->connectingTable = $tableName;
        $this->connectingColumn = $columnName;
    }

} 