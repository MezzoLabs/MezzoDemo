<?php

namespace MezzoLabs\Mezzo\Core\Schema\Relations;


class OneToMany extends Relation{

    public function manySide($tableName, $columnName){
        $this->connectingTable = $tableName;
        $this->connectingColumn = $columnName;
    }
} 