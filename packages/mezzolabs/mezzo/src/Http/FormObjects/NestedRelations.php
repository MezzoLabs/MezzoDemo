<?php


namespace Mezzolabs\Mezzo\Cockpit\Http\FormObjects;


use MezzoLabs\Mezzo\Core\Collection\StrictCollection;

class NestedRelations extends StrictCollection
{

    /**
     * Check if a item can be part of this collection.
     *
     * @param $value
     * @return boolean
     */
    protected function checkItem($value)
    {
        return $value instanceof NestedRelation;
    }

    /**
     * @return array
     */
    public function rules()
    {
        $rules = [];

        $this->each(function (NestedRelation $relation) use (&$rules) {
            $rules = array_merge($rules, $relation->rules());
        });

        return $rules;
    }
}