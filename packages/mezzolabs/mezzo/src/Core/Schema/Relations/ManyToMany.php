<?php
 

namespace MezzoLabs\Mezzo\Core\Schema\Relations;


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

        $this->connectingColumn = $columnFrom;
        $this->connectingColumn2 = $columnTo;
    }
} 