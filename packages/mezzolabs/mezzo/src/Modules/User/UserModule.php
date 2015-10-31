<?php


namespace MezzoLabs\Mezzo\Modules\User;

use App\Permission;
use App\Role;
use App\User;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Modules\User\Http\Transformers\RoleTransformer;
use MezzoLabs\Mezzo\Modules\User\Http\Transformers\UserTransformer;

class UserModule extends ModuleProvider
{
    protected $models = [
        User::class,
        Role::class,
        Permission::class
    ];

    protected $transformers = [

    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Called when module is ready, model reflections are loaded.
     *
     * @return mixed
     */
    public function ready()
    {

        $this->registerTransformers([
            User::class => UserTransformer::class,
            Role::class => RoleTransformer::class
        ]);
        //dd($tutorialReflection->relationships());
    }
}