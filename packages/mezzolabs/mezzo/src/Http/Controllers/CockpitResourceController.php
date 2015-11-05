<?php

namespace MezzoLabs\Mezzo\Http\Controllers;

use MezzoLabs\Mezzo\Cockpit\Pages\Resources\EditResourcePage;
use MezzoLabs\Mezzo\Cockpit\Pages\Resources\IndexResourcePage;
use MezzoLabs\Mezzo\Cockpit\Pages\Resources\ShowResourcePage;
use MezzoLabs\Mezzo\Exceptions\ModuleControllerException;
use MezzoLabs\Mezzo\Http\Requests\Request;
use MezzoLabs\Mezzo\Http\Requests\Resource\ResourceRequest;
use MezzoLabs\Mezzo\Http\Responses\ModuleResponse;

abstract class CockpitResourceController extends CockpitController implements ResourceControllerContract
{
    use HasModelResource;

    protected $allowStaticRepositories = false;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return ModuleResponse
     */
    abstract public function index(ResourceRequest $request);


    /**
     * Show the form for creating a new resource.
     *
     * @param ResourceRequest $request
     * @return ModuleResponse
     */
    abstract public function create(ResourceRequest $request);


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param ResourceRequest $request
     * @return ModuleResponse
     */
    abstract public function show(ResourceRequest $request, $id);

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return ModuleResponse
     */
    abstract public function edit(ResourceRequest $request, $id);

    /**
     * Check if this resource controller is correctly named (<ModelName>Controller)
     *
     * @return bool
     * @throws ModuleControllerException
     */
    public function isValid()
    {
        parent::isValid();

        return $this->assertResourceIsReflectedModel();

    }

}