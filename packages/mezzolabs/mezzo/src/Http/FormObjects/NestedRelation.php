<?php


namespace Mezzolabs\Mezzo\Cockpit\Http\FormObjects;


use Illuminate\Support\Collection;
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

    public function __construct(RelationSide $relationSide, $data)
    {
        $this->name = $relationSide->naming();
        $this->data = new Collection($data);
        $this->relationSide = $relationSide;

        $this->assertThatDataFitsRelationType();
    }


    public function relationSide()
    {
        return $this->relationSide;
    }

    /**
     * @return bool
     */
    protected function assertThatDataFitsRelationType()
    {
        $dataHasManyChildren = $this->dataHasManyChildren();

        if ($dataHasManyChildren && $this->relationSide()->hasOneChild())
            throw new InvalidNestedRelation('Cannot save many children into a relation that accepts ' .
                'only one child: "' . $this->name . '"');

        if (!$dataHasManyChildren && $this->relationSide()->hasMultipleChildren())
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


}