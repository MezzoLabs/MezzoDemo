/*@ngInject*/
export default function hrefReloadDirective(){
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