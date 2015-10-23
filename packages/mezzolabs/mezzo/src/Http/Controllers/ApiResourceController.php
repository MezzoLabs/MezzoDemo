<?php


namespace MezzoLabs\Mezzo\Http\Controllers;

use MezzoLabs\Mezzo\Exceptions\ModuleControllerException;
use MezzoLabs\Mezzo\Http\Requests\ApiRequest;
use MezzoLabs\Mezzo\Http\Requests\ApiResponseFactory;
use MezzoLabs\Mezzo\Http\Requests\CockpitRequest;

abstract class ApiResourceController extends ApiController implements ResourceControllerContract
{
    use \MezzoLabs\Mezzo\Http\Controllers\HasModelResource;

    protected $allowStaticRepositories = false;

    /**
     * Display a listing of the resource.
     *
     * @param ApiRequest $request
     * @return ApiResponseFactory
     */
    public function index(ApiRequest $request)
    {
        return $this->response()->array($this->repository()->all()->toArray());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  ApiRequest $request
     * @return ApiResponseFactory
     */
    public function store(CockpitRequest $request)
    {
        mezzo_dd($request->all());

        return $this->repository()->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return ApiResponseFactory
     */
    public function show($id)
    {
        return $this->repository()->find($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ApiRequest $request
     * @param  int $id
     * @return ApiResponseFactory
     */
    public function update(ApiRequest $request, $id)
    {
        $result = $this->repository()->update($request->all(), $id);

        return $this->response()->result($result)->withHeader('foo', 'bar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return ApiResponseFactory
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