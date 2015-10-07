<?php

namespace MezzoLabs\Mezzo\Core\Database\Reflection;

use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflector;

class EloquentReflector extends ModelReflector
{
    /**
     * Get all relationReflections
     *
     * @return Collection
     */
    public function relationReflections()
    {
        return Singleton::get('relationReflections', function () {
            $allRelations = new Collection();

            foreach ($this->reflections() as $modelReflection) {
                /** @var RelationshipReflection $relationshipReflection */
                foreach ($modelReflection->relationshipReflections() as $relationshipReflection) {
                    $allRelations->put($relationshipReflection->qualifiedName(), $relationshipReflection);
                }
            }

            return $allRelations;
        });
    }

}