<?php


namespace MezzoLabs\Mezzo\Core\Schema;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Columns\Columns;
use MezzoLabs\Mezzo\Core\Schema\Columns\ConnectingColumn;
use MezzoLabs\Mezzo\Core\Schema\Relations\Relation;

class RelationSchemas {
    /**
     * @var Collection
     */
    protected  $relations;

    /**
     * @var Columns
     */
    protected $connectingColumns;

    /**
     * @var Columns
     */
    protected $columns;

    /**
     * Creates a new relation schema for a couple of relations.
     *
     * @param array|Collection $relations
     */
    public function __construct($relations = []){
        $this->relations = new Collection();

        $this->connectingColumns = new Collection();
        $this->columns = new Collection();

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
        $this->columns = $this->columns->merge($relation->columns());
        $this->connectingColumns = $this->connectingColumns->merge($relation->connectingColumns());

        return $this->relations->put($relation->qualifiedName(), $relation);
    }

    /**
     * @return Columns
     */
    public function columns()
    {
        return $this->columns;
    }

    /**
     * Get a column via the qualified name.
     *
     * @param $name
     * @return mixed
     */
    public function column($name){
        return $this->columns->get($name);
    }

    /**
     * Get all connecting columns or filter them with a table name.
     *
     * @param string $tableName
     * @return Collection
     */
    public function connectingColumns($tableName = "")
    {
        if(empty($tableName))
            return $this->connectingColumns;

        return $this->connectingColumns->filter(function(ConnectingColumn $column) use ($tableName){
            return $column->table() === $tableName;
        });
    }

}