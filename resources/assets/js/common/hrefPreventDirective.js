/*@ngInject*/
export default function hrefPreventDirective(){
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes){
        $(element).click($event => {
            $event.preventDefault();
        });
    }
}