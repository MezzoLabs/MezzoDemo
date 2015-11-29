/*@ngInject*/
export default function compileHtmlDirective($parse, $compile){
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes){
        const expression = attributes.mezzoCompileHtml;
        const getter = $parse(expression);

        scope.$watch(getter, html => {
            if(!html){
                return;
            }

            element.html(html);
            $compile(element.contents())(scope);
        });
    }
}