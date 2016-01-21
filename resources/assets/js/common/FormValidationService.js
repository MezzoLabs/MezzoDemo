export default class FormValidationService {

    assign(formInput) {
        const $formInput = $(formInput);
        const nameAttribute = $formInput.attr('name');

        if (!nameAttribute) {
            return;
        }

        $formInput
            .attr('ng-model', `vm.inputs['${ nameAttribute }']`)
            .parents('.form-group')
            .attr('ng-class', `vm.hasError('${ nameAttribute }')`)
            .append(`<mezzo-validation-messages class="help-block" data-form-input="vm.form['${ nameAttribute }']"></mezzo-validation-messages>`);
    }

}