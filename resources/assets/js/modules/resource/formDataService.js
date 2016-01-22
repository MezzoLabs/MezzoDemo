export default class FormDataService {

    form() {
        return $('form[name="vm.form"]');
    }

    transform(data){
        var stripped = this.unfoldData(data);

        stripped = this.unpackRelationInputs(this.form()[0], stripped);
        stripped = this.formatTimestamps(stripped)
        stripped = this.flattenObject(stripped);

        return stripped;
    }

    unfoldData(formData) {
        var cleaned = {};

        if (!formData || typeof formData !== 'object')
            return formData;

        if (formData.data) {
            return this.unfoldData(formData.data);
        }


        for (var i in formData) {
            cleaned[i] = this.unfoldData(formData[i]);
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
                const checkboxName = i + '[' + relationEntry.id + ']';
                var selector = `input[type=checkbox][name="${ checkboxName }"]`;

                if ($(selector).length == 0)
                    continue;

                clean[checkboxName] = true;
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

    // Source: https://gist.github.com/penguinboy/762197
    flattenObject(ob) {
        var toReturn = {};

        for (var i in ob) {
            if (!ob.hasOwnProperty(i)) continue;

            if ((typeof ob[i]) == 'object') {
                var flatObject = this.flattenObject(ob[i]);
                for (var x in flatObject) {
                    if (!flatObject.hasOwnProperty(x)) continue;

                    toReturn[i + '.' + x] = flatObject[x];
                }
            } else {
                toReturn[i] = ob[i];
            }
        }
        return toReturn;
    }

}