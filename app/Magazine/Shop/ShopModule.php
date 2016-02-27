<?php


namespace App\Magazine\Shop;


use App\Magazine\Shop\Html\Rendering\VoucherOptionsRenderer;
use App\Magazine\Shop\Http\Transformers\RedeemersTransformerPlugin;
use MezzoLabs\Mezzo\Cockpit\Html\Rendering\AttributeRenderEngine;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Http\Transformers\TransformerRegistrar;

class ShopModule extends ModuleProvider
{
    protected $models = [
        \App\Product::class,
        \App\Order::class,
        \App\Voucher::class,
        \App\Merchant::class,
        \App\ShoppingBasket::class
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
        $this->registerTransformerPlugin();

    }

    private function registerTransformerPlugin()
    {
        $transformers = TransformerRegistrar::make();

        $transformers->registerPlugin(new RedeemersTransformerPlugin());
    }
}