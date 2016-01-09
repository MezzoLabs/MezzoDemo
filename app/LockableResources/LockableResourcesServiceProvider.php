<?php


namespace App\LockableResources;


use App\LockableResources\Http\LockedForUserTransformerPlugin;
use Illuminate\Support\ServiceProvider;
use MezzoLabs\Mezzo\Http\Transformers\TransformerRegistrar;

class LockableResourcesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerLockedSavingEvent();
        $this->registerTransformerPlugin();

    }

    protected function registerLockedSavingEvent()
    {
        $this->app['events']->listen('eloquent.saving*', function ($model) {
            if ($model instanceof LockableResource && $model->isLockedForUser()) {
                throw new ResourceLockException('Cannot save a resource that is locked by ' . $model->lockedBy->email);
            }
        });
    }

    private function registerTransformerPlugin()
    {
        $transformers = TransformerRegistrar::make();

        $transformers->registerPlugin(new LockedForUserTransformerPlugin());
    }
}