/*@ngInject*/
export default function dateTimePickerDirective() {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes) {
        const options = {
            format: 'DD.MM.YYYY HH:mm',
            showTodayButton: true,
            showClose: true,
            calendarWeeks: true,
            locale: 'de',
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

        $(element).on('dp.hide', function () {
            changed(this);
            $(this).trigger('change');
        });

        $(element).datetimepicker(options);

        changed(element);

        function changed(element) {
            var before = $(element).attr('data-before');
            var after = $(element).attr('data-after');

            var $before = (before) ? $(before) : null;
            var $after = (after) ? $(after) : null;

            if ($(element).val() == "") return true;

            var date = moment($(element).val(), options.format);

            if ($after) {
                $after.data("DateTimePicker").maxDate(date);
            }

            if ($before) {
                $before.data("DateTimePicker").minDate(date);
            }

        }
    }


}