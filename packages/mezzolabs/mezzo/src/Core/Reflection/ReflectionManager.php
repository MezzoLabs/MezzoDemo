<?php


namespace MezzoLabs\Mezzo\Core\Reflection;


use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflectionSet;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflectionSets;
use MezzoLabs\Mezzo\Core\Reflection\Reflectors\EloquentModelsReflector;
use MezzoLabs\Mezzo\Core\Reflection\Reflectors\MezzoModelsReflector;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;
use MezzoLabs\Mezzo\Exceptions\ReflectionException;

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
     * @var ModelReflectionSets
     */
    protected $modelReflectionSets;

    /**
     * @param EloquentModelsReflector $eloquentModelsReflector
     * @param MezzoModelsReflector $mezzoModelsReflector
     */
    public function __construct(EloquentModelsReflector $eloquentModelsReflector, MezzoModelsReflector $mezzoModelsReflector)
    {
        $this->eloquentModelsReflector = $eloquentModelsReflector;
        $this->mezzoModelsReflector = $mezzoModelsReflector;

        $this->modelReflectionSets = new ModelReflectionSets();
        $this->modelReflectionSets->isOverallList = true;

        /* Create eloquent and mezzo model reflections and add them
         * to the global reflection list.
         * */
        $this->eloquentModelsReflector->addToSets($this->modelReflectionSets);
        $this->mezzoModelsReflector->addToSets($this->modelReflectionSets);
    }

    /**
     * @param string $model Short or long class name or even the name of the table.
     * @return ModelReflection
     */
    public function modelReflection($model)
    {
        $reflectionSet = $this->sets()->getOrCreate($model);

        return $reflectionSet->bestReflection();
    }

    /**
     * Checks if a model is reflected.
     *
     * @param $model
     * @return bool
     */
    public function modelIsReflected($model)
    {
        return $this->sets()->hasModel($model);
    }

    /**
     * @param string $model Short or long class name or even the name of the table.
     * @return ModelReflection
     * @throws InvalidArgumentException
     */
    public function mezzoReflection($model)
    {
        $reflectionSet = $this->sets()->getOrCreate($model);

        if($reflectionSet->isMezzoModel())
            return $reflectionSet->mezzoReflection();

        throw new ReflectionException($model . ' is not a valid MezzoModel.');

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
    public function mezzoModelReflector()
    {
        return $this->mezzoModelsReflector;
    }

    /**
     * @return ModelReflectionSets
     */
    public function sets()
    {
        return $this->modelReflectionSets;
    }


    public function addToModelLookup(ModelReflectionSet $reflectionSet){
        mezzo()->makeModelLookup()->add($reflectionSet);
    }

    public function modelLookup()
    {
        return mezzo()->makeModelLookup();
    }

    /**
     * @return ReflectionManager
     */
    public static function make()
    {
        return mezzo()->makeReflectionManager();
    }



}