export default class FormValidationService {

    assign(formInput) {
        const $formInput = $(formInput);
        const nameAttribute = $formInput.attr('name');

        if (!nameAttribute) {
            return;
        }

        const $formGroup = $formInput.parents('.form-group');
        const validationMessagesTemplate = `<mezzo-validation-messages data-form-input="vm.form['${ nameAttribute }']"></mezzo-validation-messages>`;
        const ngModel = `vm.inputs['${ nameAttribute }']`;

        $formInput
            .attr('ng-model', ngModel)
            .not('[readonly],[disabled]')
            .attr('ng-disabled', 'vm.loading');

        $formGroup
            .attr('ng-class', `vm.hasError('${ nameAttribute }')`)
            .append(validationMessagesTemplate);

        const isSelect = $formInput.is('select');

        if (isSelect) {
            const firstOption = $formInput.children(':first');

            if (firstOption.length) {
                const selectDefaultValue = firstOption.val();

                $formInput.attr('ng-init', ngModel + ` = '${ selectDefaultValue }'`);
            }
        }
    }

}