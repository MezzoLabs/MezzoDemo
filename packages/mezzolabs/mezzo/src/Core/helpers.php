<?php

/**
 * Get the Mezzo core directly
 *
 * @return \MezzoLabs\Mezzo\Core\Mezzo
 */
function mezzo(){
    return app()->make('mezzo');
}