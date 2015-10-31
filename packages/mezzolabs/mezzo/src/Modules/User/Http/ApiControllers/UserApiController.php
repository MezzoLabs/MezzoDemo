<?php

namespace MezzoLabs\Mezzo\Modules\User\Http\ApiControllers;


use MezzoLabs\Mezzo\Exceptions\ModuleControllerException;
use MezzoLabs\Mezzo\Http\Controllers\ApiResourceController;
use MezzoLabs\Mezzo\Http\Requests\Resource\IndexResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\ShowResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\StoreResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\UpdateResourceRequest;
use MezzoLabs\Mezzo\Http\Responses\ApiResponseFactory;
use MezzoLabs\Mezzo\Modules\User\Http\Transformers\UserTransformer;

class UserApiController extends ApiResourceController
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexResourceRequest $request
     * @return ApiResponseFactory
     */
    public function index(IndexResourceRequest $request)
    {
        $collection = $this->repository()->all();
        return $this->response()->collection($collection, new UserTransformer());
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
        return parent::store($request);
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
        return parent::show($request, $id);
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
        return parent::update($request, $id);
    }

}