/*@ngInject*/
export default function hasControllerService($controller){
    return hasController;

    function hasController(controllerName){
        try{
            $controller(controllerName);

            return true;
        }catch(err){
            return !(err instanceof TypeError);
        }
    }
}