<?php


namespace MezzoLabs\Mezzo\Cockpit;


use Illuminate\Support\ServiceProvider;

class CockpitProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCockpit();
        $this->loadViews();
        $this->publishResources();
    }

    public function boot()
    {
        $this->includeRoutes();
    }

    /**
     * @return Cockpit
     */
    public function cockpit()
    {
        return mezzo()->make(Cockpit::class);
    }

    /**
     * Registers the cockpit singleton instance.
     */
    protected function registerCockpit()
    {
        $this->app->singleton(Cockpit::class, function($app){
            return new Cockpit($this, mezzo());
        });

        $this->app->alias('mezzo.cockpit', Cockpit::class);
    }

    /**
     * Include the basic routes for the cockpit.
     * Please note that this has nothing to do with the module routes.
     */
    protected function includeRoutes(){
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/Http/routes.php';
        }
    }

    protected function loadViews()
    {
        $this->loadViewsFrom($this->resourcesFolder('/views'), 'mezzo.cockpit');
    }

    protected function publishResources()
    {
        $this->publishes([
            $this->publicFolder() => public_path('mezzolabs/mezzo/cockpit')
        ]);
    }

    private function resourcesFolder($folder = ""){
        return __DIR__ . '/resources' . $folder;
    }

    private function publicFolder($folder = ""){
        return __DIR__ . '/public' . $folder;
    }


}