<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Database\Eloquent\Relations\Relation as EloquentRelation;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Models\MezzoEloquentModel;
use MezzoLabs\Mezzo\Core\Schema\Attributes\AttributeValue;
use MezzoLabs\Mezzo\Core\Schema\Attributes\RelationAttribute;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;
use MezzoLabs\Mezzo\Exceptions\RepositoryException;

class RelationUpdater extends EloquentRepository
{
    /**
     * @var MezzoEloquentModel
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
     * @param MezzoEloquentModel $model
     * @param AttributeValue $attributeValue
     */
    public function __construct(MezzoEloquentModel $model, AttributeValue $attributeValue)
    {
        $this->eloquentModel = $model;
        $this->attributeValue = $attributeValue;

        $this->eloquentRelation = $model->relation($attributeValue->name());


        $this->validate();
    }

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

    public function run()
    {
        /**
         * m:n Relation -> sync the Pivot
         */
        if ($this->relationSide()->isManyToMany())
            return $this->updateBelongsToManyRelation($this->eloquentRelation(), $this->newId());

        /**
         * 1:n Relation (Left side) -> update the child rows in the foreign table
         */
        if ($this->relationSide()->isOneToMany() && $this->relationSide()->hasMultipleChildren())
            return $this->updateHasManyRelation($this->eloquentRelation(), $this->newId(), $this->eloquentModel());

    }

    /**
     * @param BelongsToMany $relation
     * @param array $ids
     * @return array
     */
    protected function updateBelongsToManyRelation(BelongsToMany $relation, array $ids)
    {
        return $relation->sync($ids);
    }

    /**
     * Set the parent of many child resources.
     *
     * @param HasMany $relation
     * @param array $ids
     * @param MezzoEloquentModel $parent
     * @return bool
     * @throws InvalidArgumentException
     */
    protected function updateHasManyRelation(HasMany $relation, array $ids, MezzoEloquentModel $parent)
    {
        $foreignKey = $relation->getPlainForeignKey();

        foreach ($ids as $id) {
            if (!is_integer($id))
                throw new InvalidArgumentException($id);

            $foreignModel = $relation->getRelated();
            $foreignChild = $foreignModel->newQuery()->where($foreignModel->getQualifiedKeyName(), '=', $id);
            $result = $foreignChild->update([$foreignKey => $parent->id]);

            if (!$result)
                return false;
        }

        return true;
    }

    public function relationSide()
    {
        return $this->attribute()->relationSide();
    }

    /**
     * Id(s) that we have to update.
     *
     * @return integer|array
     */
    public function newId()
    {
        return $this->attributeValue()->value();
    }

    /**
     * @return MezzoEloquentModel
     */
    public function eloquentModel()
    {
        return $this->eloquentModel;
    }

    /**
     * @param $eloquentRelationClass
     * @return bool
     */
    protected function relationHasToBe($eloquentRelationClass)
    {
        if (!$this->eloquentRelation() instanceof $eloquentRelationClass)
            throw new RepositoryException($this->relationName() . ' is not a ' . $eloquentRelationClass . ' relation.');

        return true;
    }

    /**
     * @return BelongsTo|BelongsToMany|HasMany|HasOne|HasOneOrMany|EloquentRelation
     */
    public function eloquentRelation()
    {
        return $this->eloquentRelation;
    }


    public function relationName()
    {
        return $this->attribute()->name();
    }


}