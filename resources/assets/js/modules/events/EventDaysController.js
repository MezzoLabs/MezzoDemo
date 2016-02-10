import FormEventListener from './../../common/forms/FormEventListener';

export default class FilePickerController {

    /*@ngInject*/
    constructor(api, $scope, $element, eventDispatcher) {
        this.days = [];

        this.format = 'DD.MM.YYYY HH:mm';

        this.api = api;
        this.modelApi = api.model('EventDay');
        this.eventDispatcher = eventDispatcher;

        this.$element = $element;
        this.$form = $element.parents('form')[0];
        this.formController = null;

        var base = this;


        this.addDay();
    }

    linked(scope, element, attrs, ctrls){
        this.formController = ctrls;
        this.registerListeners();
    }

    registerListeners() {
        var receivedListener = new FormEventListener(
            'form.received',
            (event, mass) => this.fill(mass.data.days),
            this.formController
        );

        var updatedListener = new FormEventListener(
            'form.updated',
            (event, mass) => this.fill(mass.stripped.days),
            this.formController
        );


        this.eventDispatcher.listen(receivedListener);
        this.eventDispatcher.listen(updatedListener);
    }


    addDay(start = "", end = "", id = null) {
        this.days.push({
            start, end, id
        });

        $(this.$form).find('[data-mezzo-datetimepicker]').trigger('dp.refresh');

    }

    removeDay(index) {
        if (this.days.length <= 1) return false;

        var day = this.days[index];

        if (day.id) {
            this.removeDayFromServer(day);
        }

        this.days.splice(index, 1);
    }

    removeDayFromServer(day) {
        this.modelApi.delete(day.id)
            .then(response => {
                console.log(response);
            }).catch(error => {
            console.log('error', error);

        });
    }

    fill(days) {

        if (_.size(days) == 0) {
            return;
        }

        this.days = [];

        for (var i in days) {
            var day = days[i];
            this.addDay(day.start, day.end, day.id);
        }

        this.sort();
    }

    onSend(data) {

    }


    sort() {
        this.days = this.sortedDays();
    }

    sortedDays() {
        return _.sortBy(this.days, 'start');
    }

    startChanged() {
        //this.sort();
    }

    getStart() {
        return this.getDate(this.sortedDays()[0], 'start');
    }

    getEnd() {
        return this.getDate(this.sortedDays()[this.days.length - 1], 'end');
    }

    getDate(day, type) {

        if (!day)
            return null;

        if (!day[type] || day[type] == "")
            return null;

        return moment(day[type], this.format);
    }

    startString() {
        var start = this.getStart();

        if (!start) return "...";

        return start.format('dd, DD.MM.YYYY HH:mm');

    }

    endString() {
        var end = this.getEnd();
        if (!end) return "...";

        return end.format('dd, DD.MM.YYYY HH:mm');
    }


}