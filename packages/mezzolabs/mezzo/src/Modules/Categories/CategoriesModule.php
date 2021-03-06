<?php


namespace MezzoLabs\Mezzo\Modules\Categories;

use App\Category;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;

class CategoriesModule extends ModuleProvider
{
    protected $group = "admin";

    protected $models = [
        Category::class
    ];

    protected $options = [
        'title' => 'Categorization',
        'icon' => 'ion-ios-pricetags',
        'permissions' => 'administrate'

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
        $this->loadViews();
    }

    /**
     * Called when module is ready, model reflections are loaded.
     *
     * @return mixed
     */
    public function ready()
    {
    }
}