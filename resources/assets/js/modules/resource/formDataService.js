export default class FormDataService {

    form() {
        return $('form[name="vm.form"]');
    }

    get() {
        return this.form().toObject();
    }

    set(formData) {
        var stripped = this.stripData(formData);

        console.log('fill form', stripped);
        js2form(this.form()[0], stripped);
    }

    stripData(formData) {
        var cleaned = {};

        if (!formData || typeof formData !== 'object')
            return formData;

        if (formData.data)
            return this.stripData(formData.data);

        for (var i in formData) {
            cleaned[i] = this.stripData(formData[i]);
        }

        return cleaned;
    }

}