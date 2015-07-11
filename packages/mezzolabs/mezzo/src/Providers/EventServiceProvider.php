<?php


namespace MezzoLabs\Mezzo\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Bootstrap\BootProviders;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use MezzoLabs\Mezzo\Events\Core\MezzoBooted;
use MezzoLabs\Mezzo\Listeners\Core\IncludeMezzoRouting;
use MezzoLabs\Mezzo\Listeners\Core\RegisterThirdParties;
use MezzoLabs\Mezzo\Listeners\GenericMezzoListener;
use MezzoLabs\Mezzo\MezzoServiceProvider;

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

        $dispatcher->listen('bootstrapping: ' . BootProviders::class, function($app){
            $app->make('mezzo.thirdParties')->beforeProvidersBoot();
        });

        $dispatcher->listen('*', function($parameter) use ($dispatcher){

        });


    }

    /**
     * @return Dispatcher
     */
    private function getDispatcher(){
        $dispatcher = $this->app->make(Dispatcher::class);
        return $dispatcher;
    }
} 