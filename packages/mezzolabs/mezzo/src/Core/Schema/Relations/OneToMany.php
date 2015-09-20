<?php

namespace MezzoLabs\Mezzo\Core\Schema\Relations;


class OneToMany extends OneToOneOrMany{

    public function manySide($columnName, $tableName = false){
        return $this->connectVia($columnName, $tableName);
    }

}