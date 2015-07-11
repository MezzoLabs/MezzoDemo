<?php


namespace MezzoLabs\Mezzo\Listeners;


class GenericMezzoListener extends Listener
{

    /**
     * @var \Illuminate\Events\Dispatcher
     */
    private $dispatcher;

    public function __construct(\Illuminate\Events\Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * Handle the event.
     *
     * @param
     * @return void
     */
    public function handle($param = null)
    {
        var_dump($this->dispatcher->firing());
    }
} 