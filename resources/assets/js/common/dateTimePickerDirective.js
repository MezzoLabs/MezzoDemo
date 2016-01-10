/*@ngInject*/
export default function dateTimePickerDirective() {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes) {
        $(element).datetimepicker();
    }
}