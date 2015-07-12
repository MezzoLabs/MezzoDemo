<?php


namespace MezzoLabs\Mezzo\Core\Routing;


use Dingo\Api\Routing\Router;

class RoutesGenerator {

    /**
     * The Dingo api router we will fill
     *
     * @var Router
     */
    public $apiRouter;

    /**
     * Fill the api router with the generated routes
     *
     * @param Router $apiRouter
     */
    public function run(Router $apiRouter){
        $apiRouter->get('cheat', function(){
            return "callback possible";
        });
    }
} 