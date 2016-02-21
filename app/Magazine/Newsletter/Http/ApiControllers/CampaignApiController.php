<?php


namespace App\Magazine\Newsletter\Http\ApiControllers;


use App\Magazine\Newsletter\Http\Requests\StoreCampaignRequest;
use App\Magazine\Newsletter\Http\Requests\UpdateCampaignRequest;
use MezzoLabs\Mezzo\Http\Controllers\ApiResourceController;
use MezzoLabs\Mezzo\Http\Controllers\HasDefaultApiResourceFunctions;
use MezzoLabs\Mezzo\Http\Responses\ApiResponseFactory;

class CampaignApiController extends ApiResourceController
{
    use HasDefaultApiResourceFunctions {
        store as defaultStore;
        update as defaultUpdate;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCampaignRequest $request
     * @return ApiResponseFactory
     */
    public function store(StoreCampaignRequest $request)
    {
        return $this->defaultStore($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCampaignRequest $request
     * @param  int $id
     * @return ApiResponseFactory
     */
    public function update(UpdateCampaignRequest $request, $id)
    {
        return $this->defaultUpdate($request, $id);
    }
}