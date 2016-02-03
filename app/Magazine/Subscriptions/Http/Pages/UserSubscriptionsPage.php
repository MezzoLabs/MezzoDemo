<?php


namespace App\Magazine\Subscriptions\Http\Pages;

use App\Magazine\Subscriptions\Http\Controllers\UserSubscriptionsController;
use MezzoLabs\Mezzo\Modules\User\Http\Pages\User\EditUserPage;

class UserSubscriptionsPage extends EditUserPage
{
    protected $action = "subscriptions";

    protected $view = 'modules.subscriptions::pages.subscriptions';

    protected $model = \App\User::class;

    protected $controller = UserSubscriptionsController::class;

    public function boot()
    {
        $this->options('appendToUri', '');

    }

    public function overwriteUri()
    {
        $editUserPage = $this->module()->makePage(EditUserPage::class);

        return $editUserPage->uri() . '/{id}/subscriptions';
    }

}