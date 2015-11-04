<?php

namespace MezzoLabs\Mezzo\Modules\User\Http\Controllers;


use MezzoLabs\Mezzo\Http\Controllers\CockpitResourceController;
use MezzoLabs\Mezzo\Http\Requests\Resource\ResourceRequest;
use MezzoLabs\Mezzo\Http\Responses\ModuleResponse;
use MezzoLabs\Mezzo\Modules\User\Http\Pages\User\CreateUserPage;
use MezzoLabs\Mezzo\Modules\User\Http\Pages\User\EditUserPage;
use MezzoLabs\Mezzo\Modules\User\Http\Pages\User\IndexUserPage;
use MezzoLabs\Mezzo\Modules\User\Http\Pages\User\ShowUserPage;

class UserController extends CockpitResourceController
{
    /**
     * Display a listing of the resource.
     *
     * @param ResourceRequest $request
     * @return ModuleResponse
     */
    public function index(ResourceRequest $request)
    {
        return $this->page(IndexUserPage::class);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param ResourceRequest $request
     * @return ModuleResponse
     */
    public function create(ResourceRequest $request)
    {
        return $this->page(CreateUserPage::class);
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
        return $this->page(ShowUserPage::class);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return ModuleResponse
     */
    public function edit(ResourceRequest $request, $id)
    {
        return $this->page(EditUserPage::class);
    }
}