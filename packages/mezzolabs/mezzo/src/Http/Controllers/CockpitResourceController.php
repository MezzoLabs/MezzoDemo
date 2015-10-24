<?php

namespace MezzoLabs\Mezzo\Http\Controllers;

use MezzoLabs\Mezzo\Cockpit\Pages\Resources\ShowResourcePage;
use MezzoLabs\Mezzo\Exceptions\ModuleControllerException;
use MezzoLabs\Mezzo\Http\Requests\CockpitRequest;
use MezzoLabs\Mezzo\Http\Requests\ResourceRequest;
use MezzoLabs\Mezzo\Http\Responses\ModuleResponse;

abstract class CockpitResourceController extends CockpitController implements ResourceControllerContract
{
    use HasModelResource;

    protected $allowStaticRepositories = false;

    /**
     * Display a listing of the resource.
     *
     * @param CockpitRequest $request
     * @return ModuleResponse
     */
    public function index(ResourceRequest $request)
    {

    }


    /**
     * Show the form for creating a new resource.
     *
     * @param ResourceRequest $request
     * @return ModuleResponse
     */
    public function create(ResourceRequest $request)
    {
        mezzo_dd($request);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param ResourceRequest $request
     * @return ModuleResponse
     */
    public function show(ResourceRequest $request)
    {
        $resource = $this->repository->findOrFail($request->get('id', null));

        $this->page(ShowResourcePage::class);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return ModuleResponse
     */
    public function edit($id)
    {

    }

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