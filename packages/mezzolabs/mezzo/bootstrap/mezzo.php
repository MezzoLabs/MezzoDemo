<?php

$app = \Illuminate\Container\Container::getInstance();


$app->singleton('mezzo', function(\Illuminate\Container\Container $app){
    return $app->make(\MezzoLabs\Mezzo\Core\Mezzo::class);
});
