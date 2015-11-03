<?php

namespace MezzoLabs\Mezzo\Modules\FileManager\Http\Controllers;

use MezzoLabs\Mezzo\Http\Controllers\CockpitResourceController;
use MezzoLabs\Mezzo\Http\Requests\Resource\ResourceRequest;
use MezzoLabs\Mezzo\Http\Responses\ModuleResponse;
use MezzoLabs\Mezzo\Modules\FileManager\Http\Pages\CreateFilePage;
use MezzoLabs\Mezzo\Modules\FileManager\Http\Pages\IndexFilePage;

class FileController extends CockpitResourceController
{
    /**
     * Display a listing of the resource.
     *
     * @param ResourceRequest $request
     * @return ModuleResponse
     */
    public function index(ResourceRequest $request)
    {
        return $this->page(IndexFilePage::class);
    }


    public function create(ResourceRequest $request)
    {
        return $this->page(CreateFilePage::class);
    }

}