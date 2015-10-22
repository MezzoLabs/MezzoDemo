<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Http\Api;

use MezzoLabs\Mezzo\Core\Modularisation\Http\HasModelResource;
use MezzoLabs\Mezzo\Core\Modularisation\Http\ModuleRequest;
use MezzoLabs\Mezzo\Core\Modularisation\Http\ModuleResponse;
use MezzoLabs\Mezzo\Core\Modularisation\Http\ResourceController;
use MezzoLabs\Mezzo\Exceptions\ModuleControllerException;

abstract class ApiResourceController extends ApiController implements ResourceController
{
    use HasModelResource;

    protected $allowStaticRepositories = false;

    /**
     * Display a listing of the resource.
     *
     * @param ModuleRequest $request
     * @return ModuleResponse
     */
    public function index(ModuleRequest $request)
    {
        return $this->repository()->all()->toJson();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  ModuleRequest $request
     * @return ModuleResponse
     */
    public function store(ModuleRequest $request)
    {
        return $this->repository()->make($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return ModuleResponse
     */
    public function show($id)
    {
        return $this->repository()->find($id)->toJson();
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
        return $this->repository()->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return ModuleResponse
     */
    public function destroy($id)
    {
        return $this->repository()->delete($id);
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