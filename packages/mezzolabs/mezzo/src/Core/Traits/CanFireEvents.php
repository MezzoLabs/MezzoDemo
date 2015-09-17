<?php
/**
 * Created by: simon.schneider
 * Date: 17.09.2015 - 15:20
 * Project: MezzoDemo
 */
 
 

namespace MezzoLabs\Mezzo\Core\Traits;


use MezzoLabs\Mezzo\Core\Configuration\MezzoConfig;
use MezzoLabs\Mezzo\Core\Helpers\Path;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleCenter;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\Reflector;

trait CanFireEvents {
    /**
     * Throw a Mezzo event
     *
     * @param $event
     * @param  mixed $payload
     * @param  bool $halt
     * @return array|null
     */
    public function fire( $event, $payload = [], $halt = false){
        event($event, $payload, $halt);
    }
} 