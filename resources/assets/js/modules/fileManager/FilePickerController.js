export default class FilePickerController {

    /*@ngInject*/
    constructor() {
        console.log('hello there');
        console.log(this);

        $(`input[name="${ this.fieldName }"]`).val('1');
    }

}