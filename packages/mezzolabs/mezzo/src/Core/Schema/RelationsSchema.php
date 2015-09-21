<?php


namespace MezzoLabs\Mezzo\Core\Schema;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Relations\Relation;

class RelationsSchema {
    /**
     * @var Collection
     */
    protected  $relations;

    /**
     * @var Collection
     */
    protected $connectingColumns;

    /**
     * Creates a new relation schema for a couple of relations.
     *
     * @param array|Collection $relations
     */
    public function __construct($relations = []){
        $this->relations = new Collection();

        $this->connectingColumns = new Collection();

        foreach($relations as $relation){
            $this->addRelation($relation);
        }
    }

    /**
     * Add a relation to the schema. Duplicates will be removed automatically.
     *
     * @param Relation $relation
     * @return $this
     */
    public function addRelation(Relation $relation){
        $this->connectingColumns = $this->connectingColumns->merge($relation->connectingColumns());

        return $this->relations->put($relation->qualifiedName(), $relation);
    }

    /**
     * Get all connecting columns or filter them with a table name.
     *
     * @param string $tableName
     * @return Collection
     */
    public function connectingColumns($tableName = "")
    {
        if(empty($table)) return $this->connectingColumns;

        return $this->connectingColumns->filter(function($columnName) use ($tableName){
            return strstr($columnName, $tableName . '.');
        });
    }


}