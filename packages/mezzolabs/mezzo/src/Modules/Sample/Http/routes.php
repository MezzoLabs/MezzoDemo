<?php

mezzo_route()->api(function (\MezzoLabs\Mezzo\Core\Routing\ApiRouter $apiRouter) {
    $apiRouter->get('cheat2', function(){
        return "hi there";
    });
});
