<?php

namespace MezzoLabs\Mezzo\Core\Modularisation\Domain\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany as EloquentBelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany as EloquentHasOneOrMany;
use Illuminate\Database\Eloquent\Relations\Relation as EloquentRelation;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\AttributeValues;
use MezzoLabs\Mezzo\Core\Validation\HasValidationRules;
use MezzoLabs\Mezzo\Exceptions\ReflectionException;

/**
 * Class HasMezzoAnnotations
 * @package MezzoLabs\Mezzo\Core\Modularisation\Domain\Models
 *
 * @property array $rules
 * @property AttributeValues $attributeValues
 */
trait HasMezzoAnnotations
{
    use HasValidationRules;

    /**
     * @var AttributeValues
     */
    protected $attributeValues;


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
     * @return \MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflection|MezzoModelReflection
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
            throw new ReflectionException('The Model ' . get_class($this) . " doesn't have a relation named " . $relationName);

        $relation = $this->$relationName();

        if (!$relation instanceof EloquentRelation)
            throw new ReflectionException($relationName . ' is not a valid Eloquent reflection.');

        return $relation;
    }

    /**
     * Try to find the user it that owns this model.
     *
     * @return null|int
     */
    public function tryToFindOwnerId()
    {
        $ownerColumns = ['user_id', 'owner_id', 'creator_id'];

        foreach ($ownerColumns as $ownerColumn) {
            if ($this->hasAttribute($ownerColumn)) return $this->getAttribute($ownerColumn);
        }

        return null;
    }

    /**
     * Check if the a column with a certain name is known to mezzo.
     *
     * @param $name
     * @return bool
     */
    public function hasAttribute($name)
    {
        return $this->schema()->attributes()->has($name);
    }

    /**
     * Check if a user owns this model.
     *
     * @return boolean
     */
    public function isOwnedByUser(\App\User $user)
    {
        $ownerId = $this->tryToFindOwnerId();

        if(!$ownerId)
            return false;

        return intval($ownerId) === intval($user->id);
    }
}