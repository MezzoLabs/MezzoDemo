<?php

namespace MezzoLabs\Mezzo\Core\Schema\Relations;


use Illuminate\Support\Collection;

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
     * @return $this
     */
    public function connectVia($columnName, $tableName = false){
        if(!$tableName) $tableName = $this->fromTable;

        $this->connectingColumn = $columnName;
        $this->connectingTable = $tableName;
        return $this;
    }

    public function qualifiedName(){
        return $this->connectingTable . '.' . $this->connectingColumn;
    }

    protected function findConnectingColumns()
    {
        return new Collection([$this->connectingTable .'.' . $this->connectingColumn]);
    }


}