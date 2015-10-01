<?php

namespace MezzoLabs\Mezzo\Core\Schema\Relations;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Columns\Columns;
use MezzoLabs\Mezzo\Core\Schema\Columns\ConnectingColumn;

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

    /**
     * @return string
     */
    public function connectingTable()
    {
        return $this->connectingTable;
    }

    /**
     * @return string
     */
    public function connectingColumn()
    {
        return $this->connectingColumn;
    }

    /**
     * @return Columns
     */
    protected function makeColumnsCollection()
    {
        $columns = new Columns();

        $columns->addAtomicColumn($this->fromPrimaryKey(), 'integer', $this->fromTable);
        $columns->addAtomicColumn($this->toPrimaryKey(), 'integer', $this->toTable);
        $columns->addConnectingColumn($this->connectingColumn, 'integer', $this->connectingTable, $this);

        return $columns;
    }

    /**
     * @return array
     */
    protected function makeTablesArray()
    {
        return [
            $this->fromTable,
            $this->toTable
        ];
    }


}