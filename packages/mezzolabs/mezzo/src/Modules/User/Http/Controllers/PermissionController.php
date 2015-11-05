<?php

namespace MezzoLabs\Mezzo\Modules\User\Http\Controllers;


use MezzoLabs\Mezzo\Http\Controllers\CockpitResourceController;
use MezzoLabs\Mezzo\Http\Requests\Resource\ResourceRequest;
use MezzoLabs\Mezzo\Http\Responses\ModuleResponse;
use MezzoLabs\Mezzo\Modules\Permission\Http\Pages\Permission\CreatePermissionPage;
use MezzoLabs\Mezzo\Modules\Permission\Http\Pages\Permission\EditPermissionPage;
use MezzoLabs\Mezzo\Modules\Permission\Http\Pages\Permission\IndexPermissionPage;
use MezzoLabs\Mezzo\Modules\Permission\Http\Pages\Permission\ShowPermissionPage;
use MezzoLabs\Mezzo\Modules\User\Http\Pages\User\CreateUserPage;
use MezzoLabs\Mezzo\Modules\User\Http\Pages\User\EditUserPage;
use MezzoLabs\Mezzo\Modules\User\Http\Pages\User\IndexUserPage;
use MezzoLabs\Mezzo\Modules\User\Http\Pages\User\ShowUserPage;

class PermissionController extends CockpitResourceController
{
    /**
     * Display a listing of the resource.
     *
     * @param ResourceRequest $request
     * @return ModuleResponse
     */
    public function index(ResourceRequest $request)
    {
        return $this->page(IndexPermissionPage::class);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param ResourceRequest $request
     * @return ModuleResponse
     */
    public function create(ResourceRequest $request)
    {
        return $this->page(CreatePermissionPage::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param ResourceRequest $request
     * @return ModuleResponse
     */
    public function show(ResourceRequest $request, $id)
    {
        return $this->page(ShowPermissionPage::class);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return ModuleResponse
     */
    public function edit(ResourceRequest $request, $id)
    {
        return $this->page(EditPermissionPage::class);
    }
}