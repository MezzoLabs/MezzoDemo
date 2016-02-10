export default class FormDataReader{
    constructor(){

    }

    read(form ) {
        const formData = {};

        var $form = $(form);

        console.log($form.find(':input[name]'));

        $form
            .find(':input[name]')
            .each((index, formInput) => {
                //TODO Move to own function (each edge case gets one)
                const $formInput = $(formInput);
                const name = $formInput.attr('name');
                const value = $formInput.val();

                if ($formInput.is('input[type=radio]')) {
                    if (!$formInput.prop('checked')) {
                        return;
                    }
                }

                /* Start checkbox edge case */
                // match checkbox key e.g. categories[1] or categories[10]
                const regex = /(.+)\[([0-9]+)\]/i;
                const match = name.match(regex);

                if (match && $formInput.is('input[type=checkbox]')) {
                    const checkboxKey = match[1];
                    const checkboxId = match[2];
                    let checkbox = _.get(formData, checkboxKey);

                    if (!_.isArray(checkbox)) {
                        checkbox = [];

                        _.set(formData, checkboxKey, checkbox);
                    }

                    if (!$formInput.prop('checked')) {
                        return;
                    }

                    checkbox.push(checkboxId);

                    return;
                }

                if ($formInput.is('input[type=checkbox]')){
                    _.set(formData, name, ($formInput.prop('checked')) ? 1 : 0 );
                    return;
                }
                /* End checkbox edge case */

                _.set(formData, name, value);
            });

        return formData;
    }
}