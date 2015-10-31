<?php


namespace MezzoLabs\Mezzo\Http\Transformers;


use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Models\MezzoEloquentModel;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;

class EloquentModelTransformer extends ModelTransformer
{
    public function transform($model)
    {
        if(! $model instanceof MezzoEloquentModel)
            throw new InvalidArgumentException($model);

        $schema = $model->schema();

        $returnCollection = new Collection();

        $schema->attributes()->visibleOnly()->each(function(Attribute $attribute) use ($model, $returnCollection){
            $returnCollection->put($attribute->name(), $model->getAttribute($attribute->name()));
        });

        $returnCollection->put('id', $model->id);


        return $returnCollection->toArray();
    }

}