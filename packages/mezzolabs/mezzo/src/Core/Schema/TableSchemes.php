<?php


namespace MezzoLabs\Mezzo\Core\Schema;



use Illuminate\Database\Eloquent\Collection;
use MezzoLabs\Mezzo\Core\Database\Columns;

class TableSchemes extends Collection{

    /**
     * @var Columns
     */
    protected $main;

    /**
     * Add the main table for a model.
     *
     * @param Columns $tableSchema
     */
    public function addMainTable(Columns $tableSchema){
        $this->main = $tableSchema;
        $this->addTable($tableSchema);
    }

    /**
     * @param Columns $tableSchema
     */
    public function addTable(Columns $tableSchema){
        $this->put($tableSchema->name(), $tableSchema);
    }

    /**
     * Return the main table of this collection
     *
     * @return Columns
     */
    public function main()
    {
        return $this->main;
    }
} 