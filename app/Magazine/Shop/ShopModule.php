<?php


namespace App\Magazine\Shop;


use App\Magazine\Shop\Html\Rendering\VoucherOptionsRenderer;
use MezzoLabs\Mezzo\Cockpit\Html\Rendering\AttributeRenderEngine;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;

class ShopModule extends ModuleProvider
{
    protected $models = [
        \App\Product::class,
        \App\Order::class,
        \App\Merchant::class,
        \App\Voucher::class
    ];

    protected $options = [
        'icon' => 'ion-ios-cart'
    ];

    /**
     * Called when module is ready, model reflections are loaded.
     *
     * @return mixed
     */
    public function ready()
    {
        $this->loadViews();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        AttributeRenderEngine::registerHandler(VoucherOptionsRenderer::class);

    }
}