<?php

namespace MezzoLabs\Mezzo\Modules\Posts\Http\ApiControllers;


use MezzoLabs\Mezzo\Exceptions\ModuleControllerException;
use MezzoLabs\Mezzo\Http\Controllers\ApiResourceController;
use MezzoLabs\Mezzo\Http\Controllers\HasDefaultApiResourceFunctions;
use MezzoLabs\Mezzo\Http\Requests\Resource\StoreResourceRequest;
use MezzoLabs\Mezzo\Http\Responses\ApiResponseFactory;
use packages\mezzolabs\mezzo\src\Modules\Posts\Http\Requests\StorePostRequest;

class PostApiController extends ApiResourceController
{
    use HasDefaultApiResourceFunctions {
        store as defaultStore;
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
}