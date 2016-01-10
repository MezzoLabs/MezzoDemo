/*@ngInject*/
export default function dateTimePickerDirective() {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes) {
        const options = {
            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar-o',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-next',
                today: 'fa fa-crosshairs',
                clear: 'fa fa-trash-o',
                close: 'fa fa-times-circle-o'
            }
        };

        $(element).datetimepicker(options);
    }
}