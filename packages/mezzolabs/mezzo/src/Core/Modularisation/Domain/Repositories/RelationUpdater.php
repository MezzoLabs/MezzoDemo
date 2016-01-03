<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Database\Eloquent\Relations\Relation as EloquentRelation;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Models\MezzoModel;
use MezzoLabs\Mezzo\Core\Schema\Attributes\AttributeValue;
use MezzoLabs\Mezzo\Core\Schema\Attributes\RelationAttribute;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;
use MezzoLabs\Mezzo\Exceptions\RepositoryException;

class RelationUpdater extends EloquentRepository
{
    /**
     * @var MezzoModel
     */
    protected $eloquentModel;

    /**
     * @var AttributeValue
     */
    protected $attributeValue;

    /**
     * @var BelongsTo|BelongsToMany|HasOneOrMany|HasOne|HasMany|EloquentRelation
     */
    protected $eloquentRelation;

    /**
     * @param MezzoModel $model
     * @param AttributeValue $attributeValue
     */
    public function __construct(MezzoModel $model, AttributeValue $attributeValue)
    {
        $this->eloquentModel = $model;
        $this->attributeValue = $attributeValue;

        $this->eloquentRelation = $model->relation($attributeValue->name());


        $this->validate();
    }

    /**
     * Check if the construct parameters are correct.
     *
     * @return bool
     * @throws RepositoryException
     */
    protected function validate()
    {
        if (!$this->attribute() instanceof RelationAttribute)
            throw new RepositoryException($this->attribute()->qualifiedName() . ' is not a relation.');

        return true;
    }

    /**
     * @return RelationAttribute
     */
    public function attribute()
    {
        return $this->attributeValue()->attribute();
    }

    /**
     * @return AttributeValue
     */
    public function attributeValue()
    {
        return $this->attributeValue;
    }

    /**
     * @return array|bool
     * @throws InvalidArgumentException
     * @throws RepositoryException
     */
    public function run()
    {
        /**
         * m:n Relation -> sync the Pivot
         */
        if ($this->relationSide()->isManyToMany())
            return $this->updateBelongsToManyRelation($this->eloquentRelation(), $this->newIds());

        /**
         * 1:n Relation (Left side) -> update the child rows in the foreign table
         */
        if ($this->relationSide()->isOneToMany() && $this->relationSide()->hasMultipleChildren())
            return $this->updateHasManyRelation($this->eloquentRelation(), $this->newIds());

        /**
         * 1:1 Relation (Side without the joining column) -> update the foreign joining column
         */
        if ($this->relationSide()->isOneToOne() && $this->relationSide()->containsTheJoinColumn())
            return $this->updateHasOneRelation($this->eloquentRelation(), $this->newId());

        throw new RepositoryException('This relation should not be updated with the relation updater. ' .
            'Since it is a simple atomic value you should update the column of the main table instead.');

    }

    public function relationSide()
    {
        return $this->attribute()->relationSide();
    }

    /**
     * Updates m:n relationships.
     *
     * @param BelongsToMany $relation
     * @param array $ids
     * @return array
     */
    protected function updateBelongsToManyRelation(BelongsToMany $relation, array $ids)
    {
        $result = $relation->sync($ids);
        return (is_array($result));
    }

    /**
     * @return BelongsTo|BelongsToMany|HasMany|HasOne|HasOneOrMany|EloquentRelation
     */
    public function eloquentRelation()
    {
        return $this->eloquentRelation;
    }

    /**
     * The id that we have to update.
     *
     * @return int
     */
    protected function newId() : int
    {
        return $this->processId($this->attributeValue()->value());
    }

    /**
     *  Ids that we have to update.
     *
     * @return array
     */
    protected function newIds() : array
    {
        $value = $this->attributeValue()->value();

        if (is_string($value) && str_contains($value, ',')) {
            return $this->processIds(explode(',', $value));
        }

        if (is_string($value) && is_numeric($value))
            return $this->processIds([$value]);

        return $this->processIds($value);
    }

    /**
     * @param array $ids
     * @return mixed
     */
    protected function processIds(array $ids) : array
    {
        for ($i = 0; $i != count($ids); $i++) {
            $ids[$i] = $this->processId($ids[$i]);
        }

        return $ids;
    }

    /**
     * @param $id
     * @return int
     */
    protected function processId($id) : int
    {
        if (!is_numeric($id)) {
            throw new RepositoryException('Cannot update a relation with a non numeric id: "' . $id . '".');
        }

        return intval($id);
    }

    /**
     * Set the parent of many child resources (Left side of a 1:n relationship)
     *
     * @param HasMany $relation
     * @param array $ids
     * @return bool
     * @throws InvalidArgumentException
     */
    protected function updateHasManyRelation(HasMany $relation, array $ids)
    {
        $foreignKey = $relation->getPlainForeignKey();

        foreach ($ids as $id) {
            if (!is_integer($id))
                throw new InvalidArgumentException($id);

            $foreignModel = $relation->getRelated();
            $foreignChild = $foreignModel->newQuery()->where($foreignModel->getQualifiedKeyName(), '=', $id);
            $result = $foreignChild->update([$foreignKey => $this->parentId()]);

            if ($result != 1)
                return false;
        }

        return true;
    }

    public function parentId()
    {
        return $this->eloquentModel()->id;
    }

    /**
     * @return MezzoModel
     */
    public function eloquentModel()
    {
        return $this->eloquentModel;
    }

    /**
     * Update the part of a 1:1 relation that contains the joining column.
     *
     * @param HasOne $relation
     * @param $id
     * @return bool
     * @throws RepositoryException
     */
    protected function updateHasOneRelation(HasOne $relation, integer $id)
    {
        $foreignModel = $relation->getRelated();
        $foreignChild = $foreignModel->newQuery()->where($foreignModel->getQualifiedKeyName(), '=', $id);
        $foreignKey = $relation->getPlainForeignKey();
        $result = $foreignChild->update([$foreignKey => $this->parentId()]);

        return $result == 1;
    }

    public function qualifiedName()
    {
        return $this->relationSide()->relation()->qualifiedName();
    }

    /**
     * @param $eloquentRelationClass
     * @return bool
     * @throws RepositoryException
     */
    protected function relationHasToBe($eloquentRelationClass)
    {
        if (!$this->eloquentRelation() instanceof $eloquentRelationClass)
            throw new RepositoryException($this->relationName() . ' is not a ' . $eloquentRelationClass . ' relation.');

        return true;
    }

    public function relationName()
    {
        return $this->attribute()->name();
    }


}