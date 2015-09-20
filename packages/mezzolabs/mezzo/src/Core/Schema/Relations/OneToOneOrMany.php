<?php

namespace MezzoLabs\Mezzo\Core\Schema\Relations;


abstract class OneToOneOrMany extends Relation{
    /**
     * @var string
     */
    protected $connectingTable;

    /**
     * @var string
     */
    protected $connectingColumn;

    /**
     * Set up the connection from one table to another.
     *
     * @param string $columnName
     * @param bool|string $tableName
     */
    public function connectVia($columnName, $tableName = false){
        if(!$tableName) $tableName = $this->fromTable;

        $this->connectingColumn = $columnName;
        $this->connectingTable = $tableName;
    }

    public function qualifiedName(){
        return $this->connectingTable . '.' . $this->connectingColumn;
    }


}