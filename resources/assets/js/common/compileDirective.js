/*@ngInject*/
export default function compileDirective(){
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes){
        scope.$watch(attributes.mezzoCompile, directive => {
            if(directive) {
                var html = '<' + directive + ' >';

                element.html(html);
                $compile(element.contents())(scope);
            }
        });
    }
};