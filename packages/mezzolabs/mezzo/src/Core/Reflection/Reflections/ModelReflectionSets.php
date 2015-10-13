<?php


namespace MezzoLabs\Mezzo\Core\Reflection\Reflections;


use Illuminate\Database\Eloquent\Collection;
use MezzoLabs\Mezzo\Exceptions\InvalidModel;
use MezzoLabs\Mezzo\Exceptions\ReflectionException;

class ModelReflectionSets extends Collection
{
    public $items;

    public $isOverallList = false;

    /**
     * @param $model
     * @return ModelReflectionSet
     */
    public function getOrCreate($model)
    {
        if ($this->hasModel($model))
            return $this->getReflectionSet($model);
        else
            return $this->addReflectionSet($model);
    }

    /**
     * Check if this reflection collection has the model.
     *
     * @param $model
     * @return bool
     */
    public function hasModel($model)
    {
        return $this->getReflectionSet($model) !== null;
    }

    /**
     * @param mixed $model
     * @return ModelReflectionSet|null
     */
    public function getReflectionSet($model)
    {
        if ($this->has($model))
            return $this->get($model);

        if ($this->has('App\\' . $model))
            return $this->get('App\\' . $model);

        $fromAliases = $this->getFromMappings($model);
        if ($fromAliases) return $fromAliases;

        return null;
    }


    /**
     * @return ModelReflectionSets
     * @throws \Exception
     */
    public function eloquentSets()
    {
        throw new \Exception('TODO');
    }

    /**
     * @return ModelReflectionSets
     * @throws \Exception
     */
    public function mezzoTraitSets()
    {
        throw new \Exception('TODO');
    }


    /**
     * Really create a new model reflection set.
     *
     * @param $className
     * @throws InvalidModel
     * @return ModelReflectionSet
     */
    protected function makeReflectionSet($className)
    {
        if($className instanceof ModelReflectionSet)
            return $className;

        if (is_string($className))
            return new ModelReflectionSet($className);

        throw new InvalidModel($className);
    }

    /**
     * @param ModelReflectionSet $reflectionSet
     * @return ModelReflectionSet
     * @throws ReflectionException
     */
    protected function addReflectionSet($reflectionSet)
    {
        $reflectionSet = $this->makeReflectionSet($reflectionSet);

        if ($this->has($reflectionSet->className()))
            throw new ReflectionException('Reflectionset is already registered: ' . $reflectionSet->className());

        $this->put($reflectionSet->className(), $reflectionSet);
        $this->addToMapping($reflectionSet);
        $this->addToOverallList($reflectionSet);

        return $reflectionSet;
    }

    protected function addToOverallList(ModelReflectionSet $reflectionSet){
        if($this->isOverallList) return false;

        static::overall()->addReflectionSet($reflectionSet);
    }

    protected function addToMapping(ModelReflectionSet $reflectionSet)
    {
        mezzo()->makeModelMappings()->add($reflectionSet);
    }

    /**
     * Return the global ModelReflectionSets collection
     *
     * @return ModelReflectionSets
     */
    public static function overall()
    {
        return mezzo()->makeReflectionManager()->sets();
    }

    private function getFromMappings($model)
    {
        return mezzo()->makeModelMappings()->find($model);
    }



}