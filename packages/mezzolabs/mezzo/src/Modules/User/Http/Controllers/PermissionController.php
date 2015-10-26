<?php

namespace MezzoLabs\Mezzo\Modules\User\Http\Controllers;


use MezzoLabs\Mezzo\Http\Controllers\CockpitResourceController;
use MezzoLabs\Mezzo\Http\Requests\Resource\ResourceRequest;
use MezzoLabs\Mezzo\Http\Responses\ModuleResponse;
use MezzoLabs\Mezzo\Modules\User\Http\Pages\User\IndexUserPage;

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
        return $this->page(IndexUserPage::class);
    }


}