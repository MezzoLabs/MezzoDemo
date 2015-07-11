<?php

/**
 * Get the Mezzo core directly
 *
 * @return \MezzoLabs\Mezzo\Core\Mezzo
 */
function mezzo(){
    return app()->make('mezzo');
}

/**
 * The path of the mezzo folder (...vendor/mezzolabs/mezzo)
 *
 * @return string
 */
function mezzo_path(){
    return realpath(__DIR__ . "../../../");
}