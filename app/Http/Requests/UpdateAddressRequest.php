<?php

namespace App\Http\Requests;

use Auth;
use MezzoLabs\Mezzo\Http\Requests\Resource\UpdateResourceRequest;

class UpdateAddressRequest extends UpdateResourceRequest
{
    public $model = \App\Address::class;

    use HandlesAddressRequest;

    public function processData()
    {
        parent::processData();
        $this->addGeoDataViaZip();
    }

    public function getId()
    {
        return Auth::user()->address_id;
    }


}
