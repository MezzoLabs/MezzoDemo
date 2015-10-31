<?php


namespace MezzoLabs\Mezzo\Modules\User\Http\Transformers;


use App\User;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Models\MezzoEloquentModel;
use MezzoLabs\Mezzo\Http\Transformers\EloquentModelTransformer;
use MezzoLabs\Mezzo\Http\Transformers\ModelTransformer;

class UserTransformer extends EloquentModelTransformer
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'roles'
    ];

    protected $defaultIncludes = [
        'roles'
    ];

    public function transform($model)
    {
        if(! $model instanceof User)
            throw new InvalidArgumentException($model);

        return [
            'id' => $model->id,
            'name' => $model->name,
            'email' => $model->email
        ];
    }

    /**
     * Include Roles
     *
     * @param User $user
     * @return \League\Fractal\Resource\Item
     */
    public function includeRoles(User $user)
    {
        $roles = $user->roles;

        return $this->collection($roles, new RoleTransformer());
    }
}