<?php


namespace App\Magazine\Newsletter\Http\Requests;


use MezzoLabs\Mezzo\Http\Requests\Resource\StoreResourceRequest;
use MezzoLabs\Mezzo\Modules\Contents\Http\Requests\IsRequestWithContentBlocks;

class StoreCampaignRequest extends StoreResourceRequest
{
    use IsRequestWithContentBlocks;

    protected function makeFormObject()
    {

        return $this->makeContentBlocksFormObject();
    }
}