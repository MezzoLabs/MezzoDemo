<?php
 

namespace MezzoLabs\Mezzo\Core\Schema\Relations;


use MezzoLabs\Mezzo\Core\Database\Column;

class ManyToMany extends Relation{

    protected $pivotTable;

    protected $connectingColumn;

    protected $connectingColumn2;

    /**
     * @param string $tableName
     * @param string $columnFrom
     * @param string $columnTo
     */
    public function setPivot($tableName, $columnFrom, $columnTo){
        $this->pivotTable = $tableName;

        $this->connectingColumn = Column::disqualifyName($columnFrom);
        $this->connectingColumn2 = Column::disqualifyName($columnTo);
    }

    public function qualifiedName()
    {
        return $this->pivotTable;
    }
}