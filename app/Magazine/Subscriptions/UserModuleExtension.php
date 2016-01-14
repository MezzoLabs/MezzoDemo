<?php

namespace App\Magazine\Subscriptions;


use App\Magazine\Subscriptions\Html\Rendering\SubscriptionsAttributeRenderer;
use App\Magazine\Subscriptions\Http\PageExtensions\UserEditPageExtension;
use MezzoLabs\Mezzo\Cockpit\Html\Rendering\AttributeRenderEngine;
use MezzoLabs\Mezzo\Modules\User\Http\Pages\User\EditUserPage;

class UserModuleExtension extends \MezzoLabs\Mezzo\Core\Modularisation\Extensions\ModuleExtension
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->loadViewsFrom(app_path() . '/Magazine/Subscriptions/Resources/view', 'modules.subscriptions');

        AttributeRenderEngine::registerHandler(SubscriptionsAttributeRenderer::class);


        EditUserPage::registerExtension(UserEditPageExtension::class);

    }
}