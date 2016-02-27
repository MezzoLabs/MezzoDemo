<?php


namespace App\Magazine\Events;


use App\Event;
use App\EventDay;
use App\EventVenue;
use App\Magazine\Events\Domain\Validators\DaysNotOverlappingRule;
use App\Magazine\Events\Http\Transformers\EventTransformerPlugin;
use App\Magazine\Events\Schema\Rendering\EventDaysRenderer;
use App\User;
use MezzoLabs\Mezzo\Cockpit\Html\Rendering\AttributeRenderEngine;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Http\Transformers\TransformerRegistrar;

class EventsModule extends ModuleProvider
{
    protected $models = [
        Event::class,
        EventDay::class,
        EventVenue::class
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        AttributeRenderEngine::registerHandler(EventDaysRenderer::class);
        $this->registerTransformerPlugin();
    }

    /**
     * Called when all service pro
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        DaysNotOverlappingRule::register();
    }

    /**
     * Called when module is ready, model reflections are loaded.
     *
     * @return mixed
     */
    public function ready()
    {
        $this->loadViews();
    }

    private function registerTransformerPlugin()
    {
        $transformers = TransformerRegistrar::make();

        $transformers->registerPlugin(new EventTransformerPlugin());
    }
}