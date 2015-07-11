<?php


namespace MezzoLabs\Mezzo\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
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
} 