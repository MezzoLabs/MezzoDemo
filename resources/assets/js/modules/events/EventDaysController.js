export default class FilePickerController {

    constructor() {
        this.days = [];

        this.days.push({
            start: "",
            end: "",
            id: null
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

    removeDay(id) {
        delete(this.days[id]);
        console.log(this.days);

    }


}