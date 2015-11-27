<?php


namespace MezzoLabs\Mezzo\Core\Schema\Attributes;


use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputMultiple;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputSingle;
use MezzoLabs\Mezzo\Core\Schema\Relations\RelationSide;

class RelationAttribute extends Attribute
{
    /**
     * @var RelationSide
     */
    protected $relationSide;

    /**
     * @param $name
     * @param RelationSide $relationSide
     * @param array $options
     */
    public function __construct($name, RelationSide $relationSide, $options = [])
    {
        $this->name = $name;
        $this->relationSide = $relationSide;

        $this->setOptions($options);
        $this->findType();
    }

    /**
     * Find out the input type based on the side of the relation we are on.
     *
     * @return RelationInputMultiple|RelationInputSingle
     */
    protected function findType()
    {
        $annotationsType = $this->options()->get('type');

        if (!empty($annotationsType))
            $this->type = $annotationsType;
        else {
            if ($this->hasOneChild()) {
                $this->type = new RelationInputSingle();
            } else {
                $this->type = new RelationInputMultiple();
            }
        }


        return $this->type;
    }

    /**
     * @return bool
     */
    public function hasOneChild()
    {
        return $this->relationSide->hasOneChild();
    }

    /**
     * @return bool
     */
    public function hasMultipleChildren()
    {
        return $this->relationSide->hasMultipleChildren();
    }

    /**
     * @return RelationSide
     */
    public function otherRelationSide()
    {
        return $this->relationSide()->otherSide();
    }

    /**
     * @return RelationSide
     */
    public function relationSide()
    {
        return $this->relationSide;
    }

    /**
     * @return \MezzoLabs\Mezzo\Core\Schema\Relations\Relation
     */
    public function relation()
    {
        return $this->relationSide()->relation();
    }

    /**
     * Get the model reflection for the model in this side of the relation.
     *
     * @return MezzoModelReflection
     */
    public function modelReflection()
    {
        return $this->relationSide()->modelReflection();
    }

    /**
     * Get the model reflection for the model on the other side of the relation.
     *
     * @return MezzoModelReflection
     */
    public function otherModelReflection()
    {
        return $this->relationSide()->otherModelReflection();
    }

    public function query()
    {
        $query = $this->relationSide()->otherModelReflection()->instance()->query();
        $relation = $this->relation();

        $relation->getScopes()->addToQuery($query);

        return $query;
    }


}