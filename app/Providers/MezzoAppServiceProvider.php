<?php


namespace App\Providers;


use App\Magazine\Events\EventsModule;
use App\Magazine\General\GeneralModuleExtension;
use Illuminate\Support\ServiceProvider;

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

        $this->moduleCenter->registerExtensions([
            'general' => [
                GeneralModuleExtension::class
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