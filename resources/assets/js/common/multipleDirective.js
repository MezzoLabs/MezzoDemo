/*@ngInject*/
export default function multipleDirective() {
    return {
        restrict: 'A',
        link
    };
}

function link(scope, element, attributes) {
    scope.$watch(() => attributes.mezzoMultiple, isMultiple => {
        if(isMultiple) {
            element.attr('multiple', 'multiple');
        } else {
            element.removeAttr('multiple');
        }
    });
}