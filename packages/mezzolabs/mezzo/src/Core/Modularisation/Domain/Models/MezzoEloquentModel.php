<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Domain\Models;


use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany as EloquentBelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany as EloquentHasOneOrMany;
use Illuminate\Database\Eloquent\Relations\Relation as EloquentRelation;
use MezzoLabs\Mezzo\Core\Schema\Attributes\AttributeValues;
use MezzoLabs\Mezzo\Exceptions\ReflectionException;

abstract class MezzoEloquentModel extends EloquentModel implements MezzoModel
{
    protected $rules = [];

    /**
     * @var AttributeValues
     */
    protected $attributeValues;

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array $attributes
     */
    public function __construct(array $attributes = [])
    {
        return parent::__construct($attributes);
    }

    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @return \MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes
     */
    public function attributeSchemas()
    {
        return $this->schema()->attributes();
    }

    /**
     * @return \MezzoLabs\Mezzo\Core\Schema\ModelSchema
     */
    public function schema()
    {
        return $this->reflection()->schema();
    }

    /**
     * @return \MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflection
     * @throws \MezzoLabs\Mezzo\Exceptions\ReflectionException
     */
    public function reflection()
    {
        return mezzo()->makeReflectionManager()->mezzoReflection(get_class($this));
    }

    /**
     * @return AttributeValues
     */
    public function attributeValues()
    {
        if (!$this->attributeValues)
            $this->attributeValues = AttributeValues::fromModel($this);

        return $this->attributeValues;
    }

    /**
     * @param $relationName
     * @return EloquentBelongsToMany|EloquentHasOneOrMany|EloquentRelation
     * @throws ReflectionException
     */
    public function relation($relationName)
    {
        $hasRelation = method_exists($this, $relationName);

        if (!$hasRelation)
            throw new ReflectionException('The Model ' . get_class($this) . " doesn't has a relation named " . $relationName);

        $relation = $this->$relationName();

        if (!$relation instanceof EloquentRelation)
            throw new ReflectionException($relationName . ' is not a valid Eloquent reflection.');

        return $relation;
    }

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array $attributes
     * @return $this
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function fill(array $attributes)
    {
        return parent::fill($attributes);
    }


    /**
     * Sync the original attributes with the current.
     *
     * @return $this
     */
    public function syncOriginal()
    {
        $this->syncMezzoAttributes();
        return parent::syncOriginal();
    }

    protected function syncMezzoAttributes()
    {
        foreach ($this->attributes as $key => $attribute) {
            if (property_exists($this, $key)) {
                $this->$key = $attribute;
            }
        }
    }

}