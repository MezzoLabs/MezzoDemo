<?php


namespace Mezzolabs\Mezzo\Cockpit\Http\FormObjects;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use MezzoLabs\Mezzo\Core\Schema\Relations\RelationSide;
use MezzoLabs\Mezzo\Http\Exceptions\InvalidNestedRelation;

class NestedRelation
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Collection
     */
    protected $data;

    /**
     * @var RelationSide
     */
    protected $relationSide;

    /**
     * @var boolean
     */
    protected $hasManyChildren;

    public function __construct(RelationSide $relationSide, $data)
    {
        $this->name = $relationSide->naming();
        $this->data = new Collection($data);
        $this->relationSide = $relationSide;
        $this->hasManyChildren = $this->dataHasManyChildren();

        $this->assertThatDataFitsRelationType();
    }

    /**
     * @return RelationSide
     */
    public function relationSide()
    {
        return $this->relationSide;
    }

    /**
     * Get the rules for this nested relation in the dot notation.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->hasManyChildren())
            return $this->rulesForManyChildren();

        return $this->rulesForOneChild();

    }

    /**
     * @return array
     */
    protected function rulesForOneChild($prefix = '')
    {
        if (empty($prefix))
            $prefix = $this->name . '.';


        $rules = [];
        foreach ($this->related()->rules() as $shortInputName => $ruleString) {
            $rules[$prefix . $shortInputName] = $ruleString;
        }

        return $rules;
    }

    /**
     * @return array
     */
    protected function rulesForManyChildren()
    {
        $rules = [];
        foreach ($this->data as $arrayName => $values) {
            $rules = array_merge(
                $rules,
                $this->rulesForOneChild($this->name . '.' . $arrayName . '.')
            );
        }

        return $rules;
    }

    /**
     * @return Collection
     */
    public function rule($name)
    {
        return $this->related()->rules($name);
    }


    /**
     * Gets the reflection of the related model.
     *
     * @return MezzoModelReflection
     */
    public function related()
    {
        return $this->relationSide()->otherModelReflection();
    }

    /**
     * Returns the reflection of the parent models form that this relation is nested in.
     *
     * @return MezzoModelReflection
     */
    public function parent()
    {
        return $this->relationSide()->modelReflection();
    }

    /**
     * @return bool
     */
    protected function assertThatDataFitsRelationType()
    {
        if ($this->hasManyChildren && $this->relationSide()->hasOneChild())
            throw new InvalidNestedRelation('Cannot save many children into a relation that accepts ' .
                'only one child: "' . $this->name . '"');

        if (!$this->hasManyChildren && $this->relationSide()->hasMultipleChildren())
            throw new InvalidNestedRelation('Cannot save a non array into a relation that accepts ' .
                'multiple children: "' . $this->name . '"');

        return true;

    }

    /**
     * Check if the incoming data array consists out of array or atomic attributes only.
     *
     * @return bool
     */
    protected function dataHasManyChildren()
    {
        $dataHasManyChildren = false;

        $i = 0;
        foreach ($this->data as $dataEntry) {
            if (is_array($dataEntry) && $i == 0) {
                $dataHasManyChildren = true;
                break;
            }

            if (is_array($dataEntry && $i > 0)) {
                throw new InvalidNestedRelation('A nested relation can only consist out of ' .
                    'atomic values (for one child) or arrays only (for multiple children).');
            }

            $i++;
        }

        return $dataHasManyChildren;
    }

    /**
     * @return boolean
     */
    public function hasManyChildren()
    {
        return $this->hasManyChildren;
    }

    /**
     * @return boolean
     */
    public function hasOneChild()
    {
        return !$this->hasManyChildren();
    }


}