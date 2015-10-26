<?php

namespace MezzoLabs\Mezzo\Modules\Sample\Http\Controllers;

use MezzoLabs\Mezzo\Http\Controllers\CockpitResourceController;
use MezzoLabs\Mezzo\Http\Requests\Resource\ResourceRequest;
use MezzoLabs\Mezzo\Http\Responses\ModuleResponse;
use MezzoLabs\Mezzo\Modules\Sample\Http\Pages\CreateTutorialPage;
use MezzoLabs\Mezzo\Modules\Sample\Http\Pages\IndexTutorialPage;

class TutorialController extends CockpitResourceController
{
    /**
     * Display a listing of the resource.
     *
     * @param ResourceRequest $request
     * @return ModuleResponse
     */
    public function index(ResourceRequest $request)
    {
        return $this->page(IndexTutorialPage::class);
    }


    public function create(ResourceRequest $request)
    {
        return $this->page(CreateTutorialPage::class);
    }

}