export default class FilePickerController {

    /*@ngInject*/
    constructor(api, $scope, $element) {
        this.days = [];

        this.format = 'DD.MM.YYYY HH:mm';

        this.api = api;
        this.modelApi = api.model('EventDay');

        this.$element = $element;
        this.$form = $element.parents('form')[0];

        var base = this;

        $scope.$on('mezzo.formdata.set', function (event, mass) {
            base.fill(mass.data, mass.form);
        });

        this.addDay();
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
        console.log(this.days, 'removed ' + index);
    }

    removeDayFromServer(day) {
        this.modelApi.delete(day.id)
            .then(response => {
                console.log(response);
            }).catch(error => {
            console.log('error', error);

        });
    }

    fill(data, form) {
        console.log(data);
        if (form != this.$form) {
            return;
        }

        if (_.size(data.days) == 0) {
            return;
        }

        this.days = [];

        for (var i in data.days) {
            var day = data.days[i];
            this.addDay(day.start, day.end, day.id);
        }

        this.sort();
    }

    submit() {
        console.log('submit');
    }

    sort() {
        this.days = this.sortedDays();
    }

    sortedDays(){
        return _.sortBy(this.days, 'start');
    }

    startChanged(){
        this.sort();
    }

    getStart(){
        return this.getDate(this.sortedDays()[0], 'start');
    }

    getEnd(){
        return this.getDate(this.sortedDays()[this.days.length - 1], 'end');
    }

    getDate(day, type){

        if(!day)
            return null;

        if(!day[type] || day[type] == "")
            return null;

        return moment(day[type], this.format);
    }

    startString(){
        var start = this.getStart();

        if(!start) return "...";

        return start.format('dd, DD.MM.YYYY HH:mm');

    }

    endString(){
        var end = this.getEnd();
        if(!end) return "...";

        return end.format('dd, DD.MM.YYYY HH:mm');
    }


}