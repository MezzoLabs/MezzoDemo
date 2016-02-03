<?php

namespace App\Magazine\Subscriptions\Http\Controllers;

use App\Magazine\Subscriptions\Http\Pages\UserSubscriptionsPage;
use MezzoLabs\Mezzo\Http\Requests\Resource\EditResourceRequest;
use MezzoLabs\Mezzo\Modules\User\Http\Controllers\UserController;

class UserSubscriptionsController extends UserController
{
    protected $model = \App\User::class;

    public function subscriptions(EditResourceRequest $request, $id = 0)
    {
        return $this->page(UserSubscriptionsPage::class);
    }
}