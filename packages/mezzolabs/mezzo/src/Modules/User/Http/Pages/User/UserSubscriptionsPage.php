<?php


namespace MezzoLabs\Mezzo\Modules\User\Http\Pages\User;

use MezzoLabs\Mezzo\Cockpit\Pages\Resources\EditResourcePage;

class UserSubscriptionsPage extends EditUserPage
{
    protected $action = "subscriptions";

    protected $view = 'modules.user::pages.user.subscriptions';

    protected $model = \App\User::class;

}