<?php


namespace MezzoLabs\Mezzo\Cockpit;


use Illuminate\Support\ServiceProvider;
use MezzoLabs\Mezzo\Cockpit\Html\Rendering\AttributeRenderer as CockpitAttributeRenderer;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Core\Schema\Rendering\AttributeRenderer as AttributeSchemaRenderer;

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
        $this->registerRenderer();
        $this->loadViews();
        $this->publishPublicFolder();
    }

    public function boot()
    {
        $this->includeHelpers();
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
        $this->app->singleton(Cockpit::class, function () {
            return new Cockpit($this, mezzo());
        });

        $this->app->alias(Cockpit::class, 'mezzo.cockpit');


    }

    protected function includeHelpers()
    {
        require __DIR__ . '/helpers.php';
    }

    /**
     * Include the basic routes for the cockpit.
     * Please note that this has nothing to do with the module routes.
     */
    public function includeRoutes()
    {
        $allModules = mezzo()->moduleCenter()->modules();

        $allModules->each(function (ModuleProvider $moduleProvider) {
            $moduleProvider->includeRoutes();
        });

        if (! $this->app->routesAreCached()) {
            require __DIR__.'/Http/routes.php';
        }
    }


    protected function loadViews()
    {
        $this->loadViewsFrom($this->resourcesFolder('/views'), 'cockpit');
    }

    protected function publishPublicFolder()
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

    private function registerRenderer()
    {
        app()->bind(AttributeSchemaRenderer::class, CockpitAttributeRenderer::class);
    }


}