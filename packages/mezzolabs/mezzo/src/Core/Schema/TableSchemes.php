<?php


namespace MezzoLabs\Mezzo\Core\Schema;



use Illuminate\Database\Eloquent\Collection;

class TableSchemes extends Collection{

    /**
     * @var TableSchema
     */
    protected $main;

    /**
     * Add the main table for a model.
     *
     * @param TableSchema $tableSchema
     */
    public function addMainTable(TableSchema $tableSchema){
        $this->main = $tableSchema;
        $this->addTable($tableSchema);
    }

    /**
     * @param TableSchema $tableSchema
     */
    public function addTable(TableSchema $tableSchema){
        $this->put($tableSchema->name(), $tableSchema);
    }

    /**
     * Return the main table of this collection
     *
     * @return TableSchema
     */
    public function main()
    {
        return $this->main;
    }
} 