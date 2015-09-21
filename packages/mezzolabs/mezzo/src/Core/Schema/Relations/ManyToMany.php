<?php


namespace MezzoLabs\Mezzo\Core\Schema\Relations;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Database\Column;

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

        $this->connectingColumn = Column::disqualifyName($columnFrom);
        $this->connectingColumn2 = Column::disqualifyName($columnTo);
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

    /**
     * @return Collection
     */
    protected function findConnectingColumns()
    {
        return new Collection([
            $this->pivotTable . '.' . $this->connectingColumn,
            $this->pivotTable . '.' . $this->connectingColumn2
        ]);
    }
}