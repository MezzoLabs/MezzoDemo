<?php

namespace MezzoLabs\Mezzo\Modules\User\Http\Controllers;


use MezzoLabs\Mezzo\Http\Controllers\CockpitResourceController;
use MezzoLabs\Mezzo\Http\Requests\Request;
use MezzoLabs\Mezzo\Http\Requests\Resource\ResourceRequest;
use MezzoLabs\Mezzo\Http\Responses\ModuleResponse;
use MezzoLabs\Mezzo\Modules\Role\Http\Pages\Role\CreateRolePage;
use MezzoLabs\Mezzo\Modules\Role\Http\Pages\Role\EditRolePage;
use MezzoLabs\Mezzo\Modules\Role\Http\Pages\Role\IndexRolePage;
use MezzoLabs\Mezzo\Modules\Role\Http\Pages\Role\ShowRolePage;

class RoleController extends CockpitResourceController
{


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return ModuleResponse
     */
    public function index(ResourceRequest $request)
    {
        return $this->page(IndexRolePage::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ResourceRequest $request
     * @return ModuleResponse
     */
    public function create(ResourceRequest $request)
    {
        return $this->page(CreateRolePage::class);
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
        return $this->page(ShowRolePage::class);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return ModuleResponse
     */
    public function edit(ResourceRequest $request, $id)
    {
        return $this->page(EditRolePage::class);
    }
}