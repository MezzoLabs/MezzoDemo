<?php

namespace App\Providers;

use App\Magazine\Events\EventsModule;
use App\Magazine\General\GeneralModuleExtension;
use Illuminate\Support\ServiceProvider;
use MezzoLabs\Mezzo\Modules\General\GeneralModule;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        mezzo()->moduleCenter()->register(EventsModule::class);

        mezzo()->module(GeneralModule::class)->registerExtension([
            GeneralModuleExtension::class
        ]);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
        }


    }
}
