<?php


namespace MezzoLabs\Mezzo\Modules\User\Http\Transformers;


use App\Role;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Models\MezzoEloquentModel;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;
use MezzoLabs\Mezzo\Http\Transformers\EloquentModelTransformer;
use MezzoLabs\Mezzo\Http\Transformers\ModelTransformer;

class RoleTransformer extends EloquentModelTransformer
{

    public function transform($model)
    {
        if(! $model instanceof Role)
            throw new InvalidArgumentException($model);

        return ['hi' => 'there'];
    }
}