<?php

namespace MezzoLabs\Mezzo\Http\Controllers;

use MezzoLabs\Mezzo\Exceptions\ModuleControllerException;
use MezzoLabs\Mezzo\Http\Requests\ModuleRequest;
use MezzoLabs\Mezzo\Http\Responses\ModuleResponse;

abstract class ResourceController extends Controller implements ResourceControllerContract
{
    use \MezzoLabs\Mezzo\Http\Controllers\HasModelResource;

    protected $allowStaticRepositories = false;

    /**
     * Display a listing of the resource.
     *
     * @param ModuleRequest $request
     * @return ModuleResponse
     */
    public function index(ModuleRequest $request)
    {

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return ModuleResponse
     */
    public function create()
    {

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  ModuleRequest $request
     * @return ModuleResponse
     */
    public function store(ModuleRequest $request)
    {
        return $this->repository()->makeRepository($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return ModuleResponse
     */
    public function show($id)
    {
        return $this->repository->find($id);
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
     * Update the specified resource in storage.
     *
     * @param  ModuleRequest $request
     * @param  int $id
     * @return ModuleResponse
     */
    public function update(ModuleRequest $request, $id)
    {
        return $this->repository->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return ModuleResponse
     */
    public function destroy($id)
    {
        return $this->repository->delete($id);
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