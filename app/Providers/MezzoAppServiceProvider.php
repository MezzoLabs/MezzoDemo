<?php


namespace App\Providers;


use App\Magazine\Advertisements\AdvertisementsModule;
use App\Magazine\Events\EventsModule;
use App\Magazine\General\GeneralModuleExtension;
use App\Magazine\Shop\ShopModule;
use App\Magazine\Subscriptions\SubscriptionsModule;
use Illuminate\Support\ServiceProvider;
use UserModuleExtension;

class MezzoAppServiceProvider extends ServiceProvider
{
    /**
     * @var \MezzoLabs\Mezzo\Core\Mezzo
     */
    protected $mezzo;

    /**
     * @var \MezzoLabs\Mezzo\Core\Modularisation\ModuleCenter
     */
    protected $moduleCenter;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mezzo = mezzo();
        $this->moduleCenter = $this->mezzo->moduleCenter();

        $this->moduleCenter->register(EventsModule::class);
        $this->moduleCenter->register(ShopModule::class);
        $this->moduleCenter->register(SubscriptionsModule::class);
        $this->moduleCenter->register(AdvertisementsModule::class);

        $this->moduleCenter->registerExtensions([
            'general' => [
                GeneralModuleExtension::class
            ],
            'user' => [
                \App\Magazine\Subscriptions\UserModuleExtension::class
            ]
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}