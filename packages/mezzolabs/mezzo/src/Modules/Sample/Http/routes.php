<?php

use MezzoLabs\Mezzo\Core\Routing\ApiRouter;

mezzo_route()->api(function (ApiRouter $api){

    $api->resource('Sample', 'Tutorial');

});

