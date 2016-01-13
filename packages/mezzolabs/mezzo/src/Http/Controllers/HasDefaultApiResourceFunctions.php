<?php

namespace MezzoLabs\Mezzo\Http\Controllers;


use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use MezzoLabs\Mezzo\Exceptions\ModuleControllerException;
use MezzoLabs\Mezzo\Http\Requests\Queries\QueryObject;
use MezzoLabs\Mezzo\Http\Requests\Resource\DestroyResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\IndexResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\InfoResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\ShowResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\StoreResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\UpdateResourceRequest;
use MezzoLabs\Mezzo\Http\Responses\ApiResponseFactory;

/**
 * Class HasApiResourceFunctions
 * @package MezzoLabs\Mezzo\Http\Controllers
 *
 * @method ApiResponseFactory response
 * @method boolean assertResourceExists($id)
 * @method ModelRepository repository()
 * @method MezzoModelReflection model()
 */
trait HasDefaultApiResourceFunctions
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexResourceRequest $request
     * @return ApiResponseFactory
     */
    public function index(IndexResourceRequest $request)
    {
        $query = QueryObject::makeFromResourceRequest($request);
        $response = $this->response()->collection($this->repository()->all(['*'], $query), $this->bestModelTransformer());

        $response->withHeader('X-Total-Count', $this->repository()->count($query));

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreResourceRequest $request
     * @return ApiResponseFactory
     * @throws ModuleControllerException
     */
    public function store(StoreResourceRequest $request)
    {
        return $this->response()->item($this->repository()->create($request->all()), $this->bestModelTransformer());
    }

    /**
     * Display the specified resource.
     *
     * @param ShowResourceRequest $request
     * @param int $id
     * @return ApiResponseFactory
     */
    public function show(ShowResourceRequest $request, $id)
    {
        $this->assertResourceExists($id);
        return $this->response()->item($this->repository()->findOrFail($id), $this->bestModelTransformer());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateResourceRequest $request
     * @param  int $id
     * @return ApiResponseFactory
     */
    public function update(UpdateResourceRequest $request, $id)
    {
        $this->assertResourceExists($id);

        return $this->response()->item($this->repository()->update($request->all(), $id), $this->bestModelTransformer());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyResourceRequest $request
     * @param  int $id
     * @return ApiResponseFactory
     */
    public function destroy(DestroyResourceRequest $request, $id)
    {
        $this->assertResourceExists($id);
        return $this->response()->result($this->repository()->delete($id));
    }

    /**
     * @param InfoResourceRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function info(InfoResourceRequest $request)
    {

        return $this->response()->withArray($this->model()->schema()->toArray());
    }
}