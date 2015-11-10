<?php


namespace MezzoLabs\Mezzo\Modules\Categories\Http\Pages;

use App\Permission;
use MezzoLabs\Mezzo\Cockpit\Pages\Resources\ResourcePage;
use MezzoLabs\Mezzo\Modules\Categories\Http\Controllers\CategoryController;

class CategoryPage extends ResourcePage
{
    protected $action = "index";

    protected $controller = CategoryController::class;

    protected $model = Permission::class;

    protected $title = 'List Categories';

    protected $view = 'modules.categories::pages.categories';



}