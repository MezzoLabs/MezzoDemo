<?php


namespace MezzoLabs\Mezzo\Core\Schema\Relations;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Database\DatabaseColumn;
use MezzoLabs\Mezzo\Core\Schema\Columns\Columns;
use MezzoLabs\Mezzo\Core\Schema\Columns\ConnectingColumn;

class ManyToMany extends Relation
{

    protected $pivotTable;

    protected $connectingColumn;

    protected $connectingColumn2;

    /**
     * @param string $tableName
     * @param string $columnFrom
     * @param string $columnTo
     * @return $this
     */
    public function setPivot($tableName, $columnFrom, $columnTo)
    {
        $this->pivotTable = $tableName;

        $this->connectingColumn = DatabaseColumn::disqualifyName($columnFrom);
        $this->connectingColumn2 = DatabaseColumn::disqualifyName($columnTo);
        return $this;
    }

    public function qualifiedName()
    {
        return $this->pivotTable;
    }

    /**
     * @return ManyToMany
     */
    static function make()
    {
        return parent::makeByType(static::class);
    }

    protected function makeColumnsCollection()
    {
        $columns = new Columns();

        $columns->addAtomicColumn('id', 'integer', $this->fromTable);
        $columns->addAtomicColumn('id', 'integer', $this->toTable);
        $columns->addConnectingColumn($this->connectingColumn, 'integer', $this->pivotTable, $this);
        $columns->addConnectingColumn($this->connectingColumn2, 'integer', $this->pivotTable, $this);

        return $columns;
    }

    /**
     * @return array
     */
    protected function makeTablesArray()
    {
        return [
            $this->fromTable,
            $this->toTable,
            $this->pivotTable
        ];
    }
}