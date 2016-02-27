<?php


namespace App\Magazine\Newsletter\Domain\Models;


use App\Mezzo\Generated\ModelParents\MezzoCampaign;
use Illuminate\Support\Facades\Auth;

class Campaign extends MezzoCampaign
{
    /**
     * Data that will be added to the request if the field is empty
     *
     * @param array $requestData
     * @return array
     */
    public function defaultData(array $requestData) : array
    {
        return [
            'user_id' => Auth::id()
        ];
    }
}