<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Reflection;


use Illuminate\Support\Collection;

class RelationshipReflections extends Collection{
    /**
     * Filter the relations in this collection. No use for this function yet, but I think its nice to have.
     *
     * @param array $options
     * @return static
     */
    public function filterRelations($options = []){
        return $this->filter(function(RelationshipReflection $reflection) use ($options){
            $test = true;

            if(isset($options['type']) && !$reflection->is($options['type'])){
                $test = false;
            }

            if(isset($options['localColumn']) && $options['localColumn'] != $reflection->localColumn()){
                $test = false;
            }

            if(isset($options['foreignColumn']) && $options['foreignColumn'] != $reflection->localColumn()){
                $test = false;
            }

            return $test;
        });

    }

    /**
     * Find the counterpart to a certain relation reflection inside this collection.
     *
     * @param RelationshipReflection $check
     * @return RelationshipReflection | null
     * @throws \ReflectionException
     */
    public function findCounterpart(RelationshipReflection $check){
        $counterparts = $this->filter(function(RelationshipReflection $reflection) use ($check){
            return $reflection->isCounterpart($check);
        });

        if($counterparts->count() > 1)
            throw new \ReflectionException('Found more than one counterpart for one relationship. ' . $check->qualifiedName());

        if($counterparts->count() == 0){
            return null;
        }

        return $counterparts->first();
    }
} 