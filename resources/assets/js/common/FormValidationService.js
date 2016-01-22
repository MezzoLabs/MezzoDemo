export default class FormValidationService {

    assign(formInput) {
        const $formInput = $(formInput);
        const nameAttribute = $formInput.attr('name');

        if (!nameAttribute) {
            return;
        }

        const $formGroup = $formInput.parents('.form-group');

        $formInput
            .attr('ng-model', `vm.inputs['${ nameAttribute }']`)
            .not('[readonly],[disabled]')
            .attr('ng-disabled', 'vm.loading');

        $formGroup
            .attr('ng-class', `vm.hasError('${ nameAttribute }')`)
            .append(`<mezzo-validation-messages data-form-input="vm.form['${ nameAttribute }']"></mezzo-validation-messages>`);
    }

}