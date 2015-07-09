<?php

$app = app();


$app->singleton('mezzo', function(\Illuminate\Container\Container $app){
    return $app->make(\MezzoLabs\Mezzo\Core\Mezzo::class);
});


