<?php


namespace MezzoLabs\Mezzo\Core\Schema;



use Illuminate\Database\Eloquent\Collection;
use MezzoLabs\Mezzo\Core\Database\DatabaseColumns;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;

class ModelTables extends Collection{

    /**
     * @var TableSchema
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
     * Add an attribute to an existing table schema or create
     *
     * @param Attribute $attribute
     * @return Attributes\Attributes
     */
    public function addAttribute(Attribute $attribute)
    {
        if(!$attribute->hasTable())
            return $this->main->addAttribute($attribute);

        $table = $this->getOrCreateTable($attribute->getTable());

        return $table->addAttribute($attribute);
    }

    /**
     * @param TableSchema $tableSchema
     */
    public function addTable(TableSchema $tableSchema){
        $this->put($tableSchema->name(), $tableSchema);
    }

    /**
     * @param $tableName
     * @return TableSchema
     */
    public function getTable($tableName){
        return $this->get($tableName);
    }

    /**
     * @param $tableName
     * @return TableSchema
     */
    public function getOrCreateTable($tableName){
        if(!$this->has($tableName)){
            $this->addTable(new TableSchema($tableName));
        }

        return $this->getTable($tableName);
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