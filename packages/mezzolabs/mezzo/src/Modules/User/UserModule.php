<?php


namespace MezzoLabs\Mezzo\Modules\User;

use App\User;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;

class UserModule extends ModuleProvider
{
    protected $models = [
        User::class,
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

        //dd($tutorialReflection->relationships());
    }
}