<?php


namespace MezzoLabs\Mezzo\Cockpit;


use MezzoLabs\Mezzo\Core\Mezzo;

class Cockpit
{
    /**
     * @var CockpitProvider
     */
    protected $serviceProvider;

    /**
     * @var Mezzo
     */
    protected $mezzo;

    public function __construct(CockpitProvider $serviceProvider, Mezzo $mezzo)
    {
        $this->serviceProvider = $serviceProvider;
        $this->mezzo = $mezzo;
    }



}