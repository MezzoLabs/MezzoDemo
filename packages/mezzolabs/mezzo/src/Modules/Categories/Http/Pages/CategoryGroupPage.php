<?php


namespace MezzoLabs\Mezzo\Modules\Categories\Http\Pages;

use App\Permission;
use MezzoLabs\Mezzo\Cockpit\Pages\Resources\ResourcePage;
use MezzoLabs\Mezzo\Modules\Categories\Http\Controllers\CategoryGroupController;

class CategoryGroupPage extends ResourcePage
{
    protected $action = "index";

    protected $controller = CategoryGroupController::class;

    protected $model = Permission::class;

    protected $title = 'Group Categories';

    protected $view = 'modules.categories::pages.category_groups';



}