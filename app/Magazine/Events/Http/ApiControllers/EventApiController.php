<?php

namespace App\Magazine\Events\Http\ApiControllers;


use App\LockableResources\HandlesLockableApiResources;
use App\Magazine\Events\Http\Requests\StoreEventRequest;
use App\Magazine\Events\Http\Requests\UpdateEventRequest;
use MezzoLabs\Mezzo\Http\Controllers\ApiResourceController;
use MezzoLabs\Mezzo\Http\Controllers\HasDefaultApiResourceFunctions;
use MezzoLabs\Mezzo\Http\Responses\ApiResponseFactory;

class EventApiController extends ApiResourceController
{
    use HandlesLockableApiResources;

    use HasDefaultApiResourceFunctions {
        store as defaultStore;
        update as defaultUpdate;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEventRequest $request
     * @return ApiResponseFactory
     */
    public function store(StoreEventRequest $request)
    {
        return $this->defaultStore($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEventRequest $request
     * @param  int $id
     * @return ApiResponseFactory
     */
    public function update(UpdateEventRequest $request, $id)
    {

        return $this->defaultUpdate($request, $id);
    }

}