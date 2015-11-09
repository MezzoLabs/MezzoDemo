<?php


namespace MezzoLabs\Mezzo\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Bootstrap\BootProviders;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use MezzoLabs\Mezzo\Listeners\Early\DispatchAfterProvidersBooted;
use MezzoLabs\Mezzo\Listeners\Early\DispatchBeforeProvidersBoot;
use MezzoLabs\Mezzo\Listeners\GenericMezzoListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for mezzo
     *
     * @var array
     */
    protected $listen = [
        "*" => [GenericMezzoListener::class]
    ];

    /**
     * Register any other events for mezzo
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->earlyListeners();
    }

    /**
     * Register listeners even before the booting process.
     */
    private function earlyListeners()
    {
        $dispatcher = $this->getDispatcher();

        $dispatcher->listen(
            'bootstrapping: ' . BootProviders::class,
            DispatchBeforeProvidersBoot::class
        );

        $dispatcher->listen(
            'bootstrapped: ' . BootProviders::class,
            DispatchAfterProvidersBooted::class
        );

        $dispatcher->listen('*', function ($param = null, $param2 = null) use ($dispatcher) {
            //mezzo_dump($dispatcher->firing());
        });

        $dispatcher->listen('eloquent.*', function ($param = null, $param2 = null) use ($dispatcher) {
        });
    }

    /**
     * @return Dispatcher
     */
    private function getDispatcher()
    {
        $dispatcher = $this->app->make(Dispatcher::class);
        return $dispatcher;
    }
} 