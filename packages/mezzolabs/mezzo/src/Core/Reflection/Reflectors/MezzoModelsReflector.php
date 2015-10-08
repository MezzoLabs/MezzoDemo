<?php

namespace MezzoLabs\Mezzo\Core\Reflection\Reflectors;

use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflectionSet;
use MezzoLabs\Mezzo\Core\Schema\ModelSchemas;
use MezzoLabs\Mezzo\Core\Schema\RelationSchemas;

class MezzoModelsReflector extends ModelsReflector
{

    public function modelReflectionSets()
    {
        $allSets = $this->manager()->sets();

        return $allSets->filter(function (ModelReflectionSet $reflectionSet) {
            return $reflectionSet->isMezzoModel();
        });
    }


    /**
     * @return RelationSchemas
     */
    public function relationsSchema()
    {
        return $this->relationsSchema;
    }


    /**
     * @return ModelSchemas
     */
    public function modelsSchema()
    {
        return $this->modelsSchema;
    }

    /**
     * Retrieve the correct model classes from the ModelFinder.
     *
     * @return mixed
     */
    protected function findModelClasses()
    {
        return $this->finder->mezzoModelClasses();
    }

    /**
     * Produces the relation schemas out of the given model
     * information.
     *
     * @return RelationSchemas
     */
    protected function makeRelationSchemas()
    {
        // TODO: Implement makeRelationSchemas() method.
    }

    /**
     * Produces the model schemas out of the given model information or
     * the database columns.
     *
     * @return ModelSchemas
     */
    protected function makeModelSchemas()
    {
        // TODO: Implement makeModelSchemas() method.
    }

}