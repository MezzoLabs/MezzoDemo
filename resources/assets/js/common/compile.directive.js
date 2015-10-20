exports.name = 'mezzoCompile';
exports.directive = /*@ngInject*/ $compile => {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attrs){
        scope.$watch(attrs.mezzoCompile, directive => {
            if(directive) {
                var html = '<' + directive + ' >';

                element.html(html);
                $compile(element.contents())(scope);
            }
        });
    }
};