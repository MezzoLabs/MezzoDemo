<?php


namespace MezzoLabs\Mezzo\Http\Transformers;


use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Relations\Relation as EloquentRelation;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Models\MezzoEloquentModel;
use MezzoLabs\Mezzo\Core\Modularisation\NamingConvention;
use MezzoLabs\Mezzo\Core\Schema\Attributes\AttributeValue;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;

class EloquentModelTransformer extends ModelTransformer
{
    /**
     * The class name of the model which is handled by this transformer.
     *
     * @var string
     */
    protected $modelName;


    public function transform($model)
    {
        if (!$model instanceof MezzoEloquentModel)
            throw new InvalidArgumentException($model);

        $returnCollection = new Collection();

        $attributeValues = $model->attributeValues()->atomicOnly();

        $attributeValues->each(function (AttributeValue $attributeValue) use ($returnCollection) {
            $value = $this->transformValue($attributeValue);
            $returnCollection->put($attributeValue->name(), $value);
        });

        $returnCollection->put('id', $model->id);


        return $returnCollection->toArray();
    }

    protected function transformValue(AttributeValue $attributeValue)
    {
        $value = $attributeValue->value();

        if (!is_object($value))
            return $value;

        $transformer = $this->registrar()->findTransformerClass($value);

        if (!$transformer)
            return $value;

        return app($transformer)->transform($value);
    }


    /**
     * @param $modelClass
     * @return EloquentModelTransformer
     */
    public static function makeBest($modelClass)
    {
        $registrar = TransformerRegistrar::make();

        $transformer = $registrar->findTransformerClass($modelClass);

        if (!$transformer)
            return app()->make(EloquentModelTransformer::class);

        return app()->make($transformer);
    }

    /**
     * @return TransformerRegistrar
     */
    protected static function registrar()
    {
        return TransformerRegistrar::make();
    }

    /**
     * @param EloquentCollection|EloquentRelation $collection
     * @return \League\Fractal\Resource\Collection
     */
    protected function automaticCollection($collection)
    {
        $modelClass = "";
        if ($collection instanceof EloquentRelation)
            $modelClass = get_class($collection->getRelated());

        if ($collection instanceof EloquentCollection)
            $modelClass = get_class($collection->first());

        if (empty($modelClass))
            throw new InvalidArgumentException($collection);

        $transformer = $this->makeBest($modelClass);

        return $this->collection($collection, $transformer);
    }

    protected function automaticItem(MezzoEloquentModel $model)
    {
        $transformer = $this->makeBest(get_class($model));

        return $this->item($model, $transformer);
    }

    protected function addRelationsAsIncludes()
    {

    }

    protected function modelName()
    {
        if(!$this->modelName)
            return NamingConvention::modelName($this);

        return $this->modelName;
    }
}