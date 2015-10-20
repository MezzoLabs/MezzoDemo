export default { name: 'mezzoEnter', directive };

/*@ngInject*/ function directive(){
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes){
        element.bind('keypress', event => {
            if(event.which === 13){
                scope.$eval(attributes.mezzoEnter);
                scope.$apply();
            }
        });
    }
}