/*@ngInject*/
export default function quickviewDirective(quickviewService) {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes) {
        scope.$watch(() => quickviewService.open, (isOpen, wasOpen) => {
            if(isOpen === wasOpen) {
                return;
            }

            if(isOpen) {
                return $(element).addClass('opened');
            }

            return $(element).removeClass('opened');
        });
    }
}