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

        stripped = this.unpackRelationInputs(this.form()[0], stripped);
        stripped = this.formatTimestamps(stripped);

        console.log('fill form: ', stripped);

        js2form(this.form()[0], stripped);
        this.form().find(':input').trigger('input', 'triggeredByFormDataService'); // trigger input event to notify Angular that ng-model should update
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

    unpackRelationInputs(form, data) {
        var clean = _.clone(data);
        $(form).find('select').each(function (id, elem) {
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

        //unpack checkboxes
        for (var i in _.clone(clean)) {
            var attribute = clean[i];

            if (!_.isObject(attribute) || !attribute[0])
                continue;

            //run through the checkbox array (each relation entry)
            for (var j in attribute) {
                var relationEntry = attribute[j];

                var selector = 'input[type=checkbox][name="' + i + '[' + relationEntry.id + ']"]';

                if (selector.length == 0)
                    continue;

                if (!_.isArray(clean[i])) {
                    clean[i] = [];
                }
                clean[i].push(relationEntry.id);
            }
        }

        return clean;
    }

    formatTimestamps(formData) {
        var cleaned = {};

        //Unpack everything
        if (formData && _.isArray(formData)) {
            cleaned = [];
            for (var i in formData) {
                cleaned[i] = this.formatTimestamps(formData[i]);
            }
            return cleaned;
        }

        if (formData && _.isObject(formData)) {
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