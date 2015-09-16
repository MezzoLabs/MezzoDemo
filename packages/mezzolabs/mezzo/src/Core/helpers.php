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
    return realpath(__DIR__ . "/../../");
}

/**
 * The path of the mezzo folder (...vendor/mezzolabs/mezzo/src)
 *
 * @return string
 */
function mezzo_source_path(){
    return mezzo_path() . '/src/';
}