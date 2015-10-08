<?php


namespace MezzoLabs\Mezzo\Core\Reflection;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\GenericModelReflection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflectionSets;
use MezzoLabs\Mezzo\Core\Reflection\Reflectors\EloquentModelsReflector;
use MezzoLabs\Mezzo\Core\Reflection\Reflectors\MezzoModelsReflector;

class ReflectionManager
{
    /**
     * @var EloquentModelsReflector
     */
    protected $eloquentModelsReflector;

    /**
     * @var MezzoModelsReflector
     */
    protected $mezzoModelsReflector;

    /**
     * Run method already called successfully.
     *
     * @var boolean
     */
    protected $booted;

    /**
     * @var ModelReflectionMappings
     */
    protected $modelReflectionMappings;

    /**
     * @param EloquentModelsReflector $eloquentModelsReflector
     * @param MezzoModelsReflector $mezzoModelsReflector
     */
    public function __construct(EloquentModelsReflector $eloquentModelsReflector, MezzoModelsReflector $mezzoModelsReflector)
    {
        $this->eloquentModelsReflector = $eloquentModelsReflector;
        $this->mezzoModelsReflector = $mezzoModelsReflector;
        $this->modelReflectionMappings = new ModelReflectionMappings();
    }

    /**
     * @param string $model Short or long class name or even the name of the table.
     * @return GenericModelReflection
     */
    public function modelReflection($model)
    {
        $reflectionFromMapping = $this->mappings()->findClassName($model);

        $className = GenericModelReflection::modelStringOrFail($model);

        if(ModelFinder::classUsesMezzoTrait($className))
            $reflection = $this->mezzoModelsReflector()->modelReflection($model);
        else
            $reflection = $this->eloquentModelsReflector()->modelReflection($model);

        return $this->allModelReflections->getOrCreate($model);
    }

    /**
     * Load the class names into the fitting collections.
     */
    public function run()
    {
        if ($this->booted) return false;

        $this->eloquentModels = $this->findEloquentModels();
        $this->mezzoModels = $this->findMezzoModels();

        $this->allModelReflections = new ModelReflectionSets($this->mezzoModels);

        $this->relationsSchema = $this->buildRelationSchemas();
        $this->modelsSchema = $this->buildModelSchemas();

        $this->booted = true;

    }

    /**
     * @return EloquentModelsReflector
     */
    public function eloquentModelsReflector()
    {
        return $this->eloquentModelsReflector;
    }

    /**
     * @return MezzoModelsReflector
     */
    public function mezzoModelsReflector()
    {
        return $this->mezzoModelsReflector;
    }

    public function addToMapping(GenericModelReflection $modelReflection)
    {
        $this->mappings()->add($modelReflection);
    }

    /**
     * @return ModelReflectionMappings
     */
    public function mappings()
    {
        return $this->modelReflectionMappings;
    }


}