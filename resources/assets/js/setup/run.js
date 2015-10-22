import jquery from './jquery';

export default run;

/*@ngInject*/ function run($rootScope, $state){
    $rootScope.aside = aside;

    jquery();

    function aside(){
        var views = $state.current.views;

        if(views){
            return views.aside;
        }

        return false;
    }
}