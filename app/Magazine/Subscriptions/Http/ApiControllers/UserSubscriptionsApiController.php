<?php

namespace App\Magazine\Subscriptions\Http\ApiControllers;


use App\Magazine\Subscriptions\Domain\Repositories\SubscriptionRepository;
use MezzoLabs\Mezzo\Http\Controllers\ApiResourceController;
use MezzoLabs\Mezzo\Http\Controllers\HasDefaultApiResourceFunctions;
use MezzoLabs\Mezzo\Http\Requests\Queries\QueryObject;
use MezzoLabs\Mezzo\Http\Requests\Resource\IndexResourceRequest;
use MezzoLabs\Mezzo\Modules\User\Domain\Repositories\UserRepository;

class UserSubscriptionsApiController extends ApiResourceController
{
    use HasDefaultApiResourceFunctions {
        index as resourceIndex;
        store as defaultStore;
        update as defaultUpdate;
    }

    public $model = \App\User::class;
    /**
     * @var UserRepository
     */
    private $users;
    /**
     * @var SubscriptionRepository
     */
    private $subscriptions;

    public function __construct(UserRepository $users, SubscriptionRepository $subscriptions)
    {
        $this->users = $users;

        $this->subscriptions = $subscriptions;
    }

    /**
     * @return \MezzoLabs\Mezzo\Core\Schema\Attributes\RelationAttribute
     * @throws \MezzoLabs\Mezzo\Exceptions\ReflectionException
     */
    public function relationAttribute()
    {
        return mezzo()->attribute(\App\User::class, 'subscriptions');
    }

    public function index(IndexResourceRequest $request, $id)
    {
        $user = $this->users->findOrFail($id);

        return $this->resourceResponse()->indexRelation($user->subscriptions(), $request->queryObject(), $this->subscriptions);
    }
}