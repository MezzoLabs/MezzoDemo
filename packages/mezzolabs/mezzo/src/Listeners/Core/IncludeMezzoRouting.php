<?php


namespace MezzoLabs\Mezzo\Listeners\Core;


use MezzoLabs\Mezzo\Events\Core\MezzoBooted;
use MezzoLabs\Mezzo\Listeners\Listener;

class IncludeMezzoRouting extends Listener
{
     /**
     * Handle the event.
     *
     * @param  MezzoBooted  $event
     * @return void
     */
    public function handle(MezzoBooted $event)
    {
        if (! app()->routesAreCached()) {
            require __DIR__.'../../Http/routes.php';
        }

    }
}