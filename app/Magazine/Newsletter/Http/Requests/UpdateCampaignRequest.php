<?php


namespace App\Magazine\Newsletter\Http\Requests;


use MezzoLabs\Mezzo\Http\Requests\Resource\UpdateResourceRequest;
use MezzoLabs\Mezzo\Modules\Contents\Http\Requests\IsRequestWithContentBlocks;

class UpdateCampaignRequest extends UpdateResourceRequest
{
    use IsRequestWithContentBlocks;

    protected function makeFormObject()
    {
        return $this->makeContentBlocksFormObject();
    }
}