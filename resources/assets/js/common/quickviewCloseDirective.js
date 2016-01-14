/*@ngInject*/
export default function quickviewCloseDirective(quickviewService) {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes) {
        $(element).click(() => {
            quickviewService.open = false;

            scope.$apply();
        });
    }
}