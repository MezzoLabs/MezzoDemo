<?php

namespace MezzoLabs\Mezzo\Core\Schema\Relations;


class OneToMany extends Relation{

    public function manySide($columnName, $tableName = false){

        $this->connectingTable = $tableName;
        $this->connectingColumn = $columnName;
    }
} 