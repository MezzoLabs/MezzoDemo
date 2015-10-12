<?php


namespace MezzoLabs\Mezzo\Core\Schema\Converters\Annotations;


use MezzoLabs\Mezzo\Core\Annotations\Reader\RelationAnnotations;
use MezzoLabs\Mezzo\Core\Schema\Converters\Converter;
use MezzoLabs\Mezzo\Core\Schema\Relations\ManyToMany;
use MezzoLabs\Mezzo\Core\Schema\Relations\OneToOneOrMany;
use MezzoLabs\Mezzo\Core\Schema\Relations\Relation;

class RelationAnnotationsConverter extends Converter
{
    /**
     * @param mixed $toConvert
     * @return Relation
     */
    public function run($toConvert)
    {
        return $this->fromAnnotationsToRelation($toConvert);
    }

    /**
     * @param RelationAnnotations $relationAnnotations
     * @return Relation
     */
    protected function fromAnnotationsToRelation(RelationAnnotations $relationAnnotations)
    {

        if ($relationAnnotations->isOneToOneOrMany())
            return $this->makeOneToOneOrMany($relationAnnotations);

        return $this->makeManyToMany($relationAnnotations);
    }

    /**
     * @param RelationAnnotations $relationAnnotations
     * @return OneToOneOrMany
     */
    protected function makeOneToOneOrMany(RelationAnnotations $relationAnnotations)
    {
        $relation = $this->makeRelationBase($relationAnnotations);

        $joinColumnAnnotation = $relationAnnotations->joinColumn();

        $relation->connectVia($joinColumnAnnotation->column, $joinColumnAnnotation->table);

        return $relation;
    }

    /**
     * Create a new relation instance with the values that are the same across all relations.
     *
     * @return OneToOneOrMany|ManyToMany
     */
    protected function makeRelationBase(RelationAnnotations $relationAnnotations)
    {
        $relation = Relation::makeByType($relationAnnotations->relationClass());

        $from = $relationAnnotations->from();
        $to = $relationAnnotations->to();

        $relation->from($from->table, $from->naming);
        $relation->to($to->table, $to->naming);

        return $relation;
    }

    /**
     * @param RelationAnnotations $relationAnnotations
     * @return ManyToMany|OneToOneOrMany
     */
    protected function makeManyToMany(RelationAnnotations $relationAnnotations)
    {
        $relation = $this->makeRelationBase($relationAnnotations);

        $pivotAnnotation = $relationAnnotations->pivotTable();

        $relation->setPivot($pivotAnnotation->name, $pivotAnnotation->fromColumn, $pivotAnnotation->toColumn);

        return $relation;
    }
}