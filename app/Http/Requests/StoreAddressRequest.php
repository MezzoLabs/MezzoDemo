<?php


namespace App\Http\Requests;


use App\Repositories\ZipCodeRepository;
use MezzoLabs\Mezzo\Http\Requests\Resource\StoreResourceRequest;

class StoreAddressRequest extends StoreResourceRequest
{
    public $model = \App\Address::class;

    use HandlesAddressRequest;

    public function processData()
    {
        parent::processData();
        $this->addGeoDataViaZip();
    }

}