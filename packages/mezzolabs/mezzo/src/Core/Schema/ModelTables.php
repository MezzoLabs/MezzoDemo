<?php


namespace MezzoLabs\Mezzo\Core\Schema;



use Illuminate\Database\Eloquent\Collection;
use MezzoLabs\Mezzo\Core\Database\DatabaseColumns;

class ModelTables extends Collection{

    /**
     * @var DatabaseColumns
     */
    protected $main;

    /**
     * @var ModelSchema
     */
    protected $modelSchema;

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
     * @return DatabaseColumns
     */
    public function main()
    {
        return $this->main;
    }

    /**
     * @return ModelSchema
     */
    public function modelSchema()
    {
        return $this->modelSchema;
    }

    /**
     * @param ModelSchema $modelSchema
     */
    public function setModel(ModelSchema $modelSchema)
    {
        $this->modelSchema = $modelSchema;
    }


} 