<?php

use MezzoLabs\Mezzo\Core\Routing\ApiRouter;

mezzo_route()->api(function (ApiRouter $api) {


    $api->get('cheat2', function(){
        return "hi there";
    });

});

