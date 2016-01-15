export default class FormDataService {

    form() {
        return $('form[name="vm.form"]');
    }

    get() {
        return this.form().toObject();
    }

    set(formData) {
        console.log('received data: ', formData);

        var stripped = this.stripData(formData);

        stripped = this.unpackSelectInputs(this.form()[0], stripped);
        stripped = this.formatTimestamps(stripped);

        console.log('fill form: ', stripped);

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

    unpackSelectInputs(form, data) {
        var clean = _.clone(data);
        $(form).find('select').each(function (id, elem) {
            var name = $(this).attr('name');

            //html input element is not in response or already an id
            if (!clean[name] || typeof clean[name] !== 'object')
                return true;

            // not an array
            if (!clean[name][0]) {
                clean[name] = clean[name].id;
                return true;
            }

            //unpack the array of relation elements
            var ids = [];
            for (var i in clean[name]) {
                ids.push(clean[name][i].id);
            }

            clean[name] = ids;
        });

        return clean;
    }

    formatTimestamps(formData) {
        var cleaned = {};

        //Unpack everything
        if (formData && typeof formData === 'object') {
            for (var i in formData) {
                cleaned[i] = this.formatTimestamps(formData[i]);
            }
            return cleaned;
        }

        //Only the atomic values will land here (science bitch!)

        if (typeof formData == "string" && formData.match(/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/)) {
            return moment(formData).format('DD.MM.YYYY HH:mm');
        }

        return formData;
    }

}