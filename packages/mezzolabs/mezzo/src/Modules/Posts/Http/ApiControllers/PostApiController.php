<?php

namespace MezzoLabs\Mezzo\Modules\Posts\Http\ApiControllers;


use MezzoLabs\Mezzo\Exceptions\ModuleControllerException;
use MezzoLabs\Mezzo\Http\Controllers\ApiResourceController;
use MezzoLabs\Mezzo\Http\Controllers\HasDefaultApiResourceFunctions;
use MezzoLabs\Mezzo\Http\Requests\Resource\StoreResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\UpdateResourceRequest;
use MezzoLabs\Mezzo\Http\Responses\ApiResponseFactory;
use packages\mezzolabs\mezzo\src\Modules\Posts\Http\Requests\StorePostRequest;
use packages\mezzolabs\mezzo\src\Modules\Posts\Http\Requests\UpdatePostRequest;

class PostApiController extends ApiResourceController
{
    use HasDefaultApiResourceFunctions {
        store as defaultStore;
        update as defaultUpdate;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreResourceRequest $request
     * @return ApiResponseFactory
     * @throws ModuleControllerException
     */
    public function store(StorePostRequest $request)
    {
        $page = $this->repository()->createWithNestedRelations($request->all(), $request->formObject()->nestedRelations());

        return $this->response()->item($page, $this->bestModelTransformer());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateResourceRequest $request
     * @param  int $id
     * @return ApiResponseFactory
     */
    public function update(UpdatePostRequest $request, $id)
    {
        return $this->defaultUpdate($request, $id);
    }
}