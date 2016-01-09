<?php


namespace App\Http\Requests;


use MezzoLabs\Mezzo\Http\Requests\Resource\StoreResourceRequest;

class StoreAddressRequest extends StoreResourceRequest
{
    public $model = \App\Address::class;
}