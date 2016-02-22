<?php


namespace App\Magazine\Newsletter\Http\ApiControllers;


use App\Magazine\Newsletter\Domain\Repositories\CampaignRepository;
use App\Magazine\Newsletter\Domain\Services\CampaignDeliverer;
use App\Magazine\Newsletter\Http\Requests\DeliverCampaignRequest;
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
     * @var CampaignDeliverer
     */
    private $deliverer;
    /**
     * @var CampaignRepository
     */
    private $campaigns;

    public function __construct(CampaignDeliverer $deliverer, CampaignRepository $campaigns)
    {
        $this->deliverer = $deliverer;
        $this->campaigns = $campaigns;
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

    /**
     * @param DeliverCampaignRequest $request
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function deliver(DeliverCampaignRequest $request, $id)
    {
        $mails = [];

        if ($request->get('mode') == 'test') {
            $mails = ['trigger3@hotmail.de'];
        }

        $delivered = $this->deliverer->deliver($request->currentModelInstance(), $mails);

        if (!$delivered) {
            return $this->response()->result(2, "Delivery failed", "Error");
        }

        return $this->response()->result(1, "Campaign delivered to " . $this->deliverer->recipients()->count() . ' users.');
    }
}