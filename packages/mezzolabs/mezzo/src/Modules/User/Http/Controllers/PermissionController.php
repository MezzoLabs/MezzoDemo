<?php

namespace MezzoLabs\Mezzo\Modules\User\Http\Controllers;


use MezzoLabs\Mezzo\Http\Controllers\CockpitResourceController;
use MezzoLabs\Mezzo\Http\Requests\Resource\ResourceRequest;
use MezzoLabs\Mezzo\Http\Responses\ModuleResponse;
use MezzoLabs\Mezzo\Modules\Permission\Http\Pages\Permission\CreateCategoryPage;
use MezzoLabs\Mezzo\Modules\Permission\Http\Pages\Permission\EditPermissionPage;
use MezzoLabs\Mezzo\Modules\Permission\Http\Pages\Permission\IndexCategoryPage;
use MezzoLabs\Mezzo\Modules\Permission\Http\Pages\Permission\ShowCategoryPage;

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
        return $this->page(IndexCategoryPage::class);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param ResourceRequest $request
     * @return ModuleResponse
     */
    public function create(ResourceRequest $request)
    {
        return $this->page(CreateCategoryPage::class);
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
        return $this->page(ShowCategoryPage::class);
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