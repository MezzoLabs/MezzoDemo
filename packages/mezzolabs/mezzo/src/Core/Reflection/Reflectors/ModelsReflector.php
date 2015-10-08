<?php


namespace MezzoLabs\Mezzo\Core\Reflection\Reflectors;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\Reflection\ModelFinder;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\GenericModelReflection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflectionSets;
use MezzoLabs\Mezzo\Core\Schema\ModelSchemas;
use MezzoLabs\Mezzo\Core\Schema\RelationSchemas;

abstract class ModelsReflector
{
    /**
     * @var ModelFinder
     */
    protected $finder;

    /**
     * @var Mezzo
     */
    protected $mezzo;

    /**
     * @var RelationSchemas
     */
    protected $relationSchemas;

    /**
     * @var ModelSchemas
     */
    protected $modelSchemas;

    /**
     * @var Collection
     */
    protected $modelClasses;

    /**
     * @var ModelReflectionSets
     */
    protected $modelReflections;

    /**
     * Create a new model reflector instance.
     *
     * @param ModelFinder $finder
     * @param Mezzo $mezzo
     */
    final public function __construct(ModelFinder $finder, Mezzo $mezzo){
        $this->finder = $finder;
        $this->mezzo = $mezzo;
    }

    /**
     * Retrieve the correct model classes from the ModelFinder.
     *
     * @return Collection
     */
    abstract protected function findModelClasses();

    /**
     * Returns the found model class names.
     *
     * @return Collection
     */
    final public function modelClasses(){
        if(!$this->modelClasses)
            $this->modelClasses = $this->findModelClasses();

        return $this->modelClasses;
    }

    /**
     * Produces the relation schemas out of the given model
     * information.
     *
     * @return RelationSchemas
     */
    abstract protected function makeRelationSchemas();

    /**
     * Returns the relation schemas that were produced out of the given
     * model information.
     *
     * @return RelationSchemas
     */
    final public function relationSchemas()
    {
        if(!$this->relationSchemas)
            $this->relationSchemas = $this->makeRelationSchemas();

        return $this->relationSchemas;
    }

    /**
     * Produces the model schemas out of the given model information or
     * the database columns.
     *
     * @return ModelSchemas
     */
    abstract protected function makeModelSchemas();

    /**
     * Returns the model schemas that were produced out of the given
     * model information / database columns.
     *
     * @return ModelSchemas
     */
    final public function modelSchemas()
    {
        if(!$this->relationSchemas)
            $this->relationSchemas = $this->makeRelationSchemas();

        return $this->relationSchemas;
    }

    /**
     * Get the all reflections from the found models.
     *
     * @return ModelReflectionSets
     */
    protected function modelReflections(){
        if(!$this->modelReflections)
            $this->modelReflections = $this->makeModelReflections();

        return $this->modelReflections;
    }

    /**
     * Create the model reflections collection via the found model classes.
     *
     * @return ModelReflectionSets
     */
    private function makeModelReflections(){
        return new ModelReflectionSets($this->modelClasses());
    }

    /**
     * Get the reflection of the given model or create one
     *
     * @param $model
     * @return GenericModelReflection
     */
    public function modelReflection($model)
    {
        return $this->modelReflections()->getOrCreate($model);
    }
}