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
     * Creates a new relation schema for a couple of relations.
     *
     * @param array|Collection $relations
     */
    public function __construct($relations = []){
        $this->relations = new Collection();

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
        return $this->relations->put($relation->qualifiedName(), $relation);
    }
} 