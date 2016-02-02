<?php

namespace App\Magazine\Subscriptions\Http\ApiControllers;


use MezzoLabs\Mezzo\Http\Controllers\ApiResourceController;
use MezzoLabs\Mezzo\Http\Controllers\HasDefaultApiResourceFunctions;
use MezzoLabs\Mezzo\Http\Requests\Queries\QueryObject;
use MezzoLabs\Mezzo\Http\Requests\Resource\IndexResourceRequest;

class UserSubscriptionsApiController extends ApiResourceController
{
    use HasDefaultApiResourceFunctions {
        index as resourceIndex;
        store as defaultStore;
        update as defaultUpdate;
    }

    public $model = \App\User::class;

    /**
     * @return \MezzoLabs\Mezzo\Core\Schema\Attributes\RelationAttribute
     * @throws \MezzoLabs\Mezzo\Exceptions\ReflectionException
     */
    public function relationAttribute()
    {
        return mezzo()->attribute(\App\User::class, 'subscriptions');
    }

    public function index(IndexResourceRequest $request)
    {
        $this->resourceIndex($request);
    }
}