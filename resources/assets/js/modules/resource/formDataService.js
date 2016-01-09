export default class FormDataService {

    form() {
        return $('form[name="vm.form"]');
    }

    get() {
        return this.form().toObject();
    }

    set(formData) {
        js2form(this.form()[0], formData);
    }

}