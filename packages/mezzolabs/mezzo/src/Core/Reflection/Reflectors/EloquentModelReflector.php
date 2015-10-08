<?php

namespace MezzoLabs\Mezzo\Core\Reflection\Reflectors;

use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\EloquentModelReflection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\EloquentRelationshipReflection;
use MezzoLabs\Mezzo\Core\Schema\ModelSchemas;
use MezzoLabs\Mezzo\Core\Schema\RelationSchemas;

class EloquentModelsReflector extends ModelsReflector
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

            foreach ($this->modelReflections() as $modelReflection) {
                /** @var EloquentRelationshipReflection $relationshipReflection */
                foreach ($modelReflection->relationshipReflections() as $relationshipReflection) {
                    $allRelations->put($relationshipReflection->qualifiedName(), $relationshipReflection);
                }
            }

            return $allRelations;
        });
    }

    /**
     * Retrieve the correct model classes from the ModelFinder.
     *
     * @return mixed
     */
    protected function findModelClasses()
    {
        return $this->finder->eloquentModelClasses();
    }

    /**
     * Produces the relation schemas out of the given model
     * information.
     *
     * @return RelationSchemas
     */
    protected function makeRelationSchemas()
    {
        $relationReflections = $this->relationReflections();

        $relationSchemas = new RelationSchemas();

        $relationReflections->each(
            function (EloquentRelationshipReflection $reflection) use ($relationSchemas) {
                $relationSchemas->addRelation($reflection->relationSchema());
            });

        return $relationSchemas;
    }

    /**
     * Produces the model schemas out of the given model information or
     * the database columns.
     *
     * @return ModelSchemas
     */
    protected function makeModelSchemas()
    {
        $modelReflections = $this->modelReflections();

        $modelsSchema = new ModelSchemas();

        $modelReflections->each(function (EloquentModelReflection $reflection) use ($modelsSchema) {
            $modelsSchema->addSchema($reflection->schema());
        });

        return $modelsSchema;
    }
}