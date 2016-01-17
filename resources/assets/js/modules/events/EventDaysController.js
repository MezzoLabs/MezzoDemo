export default class FilePickerController {

    constructor() {
        this.days = [];

        this.days.push({
            start: "11.12.1991 12:30",
            end: "12.12.1991 12:30",
            id: 1
        });


    }

    addDay() {
        this.days.push({
            start: "",
            end: "",
            id: null
        });

        console.log(this.days);
    }

    removeDay(index) {
        this.days.splice(index, 1);
        console.log(this.days, 'removed ' + index);

    }

    fill() {

    }


}