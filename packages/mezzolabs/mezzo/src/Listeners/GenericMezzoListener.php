<?php


namespace MezzoLabs\Mezzo\Listeners;


class GenericMezzoListener extends Listener{
    /**
     * Handle the event.
     *
     * @param
     * @return void
     */
    public function handle($param)
    {
        dd('mezzo event thrown');
    }
} 