/*@ngInject*/
export default function select2Directive(){
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes){
        $(element).select2();
    }
}