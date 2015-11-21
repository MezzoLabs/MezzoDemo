<?php


namespace MezzoLabs\Mezzo\Modules\Posts;


use App\User;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;

class PostsModule extends ModuleProvider
{
    protected $models = [
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
        $this->loadViews();
    }
}