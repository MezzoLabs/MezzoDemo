<?php


namespace App\LockableResources;


use Illuminate\Support\ServiceProvider;

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

    }

    protected function registerLockedSavingEvent()
    {
        $this->app['events']->listen('eloquent.saving*', function ($model) {
            if ($model instanceof LockableResource && $model->isLockedForUser()) {
                throw new ResourceLockException('Cannot save a resource that is locked by ' . $model->lockedBy->email);
            }
        });
    }
}