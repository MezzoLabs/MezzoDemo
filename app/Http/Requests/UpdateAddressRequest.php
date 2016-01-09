<?php

namespace App\Http\Requests;

use MezzoLabs\Mezzo\Http\Requests\Resource\UpdateResourceRequest;

class UpdateAddressRequest extends UpdateResourceRequest
{
    public $model = \App\Address::class;

}
