export default class FormValidationService {

    assign(formInput) {
        const $formInput = $(formInput);
        const nameAttribute = $formInput.attr('name');

        if (!nameAttribute) {
            return;
        }

        const $formGroup = $formInput.parents('.form-group');
        const validationMessagesTemplate = `<mezzo-validation-messages></mezzo-validation-messages>`;
        const ngModel = `vm.inputs['${ nameAttribute }']`;

        this.addModelConnection($formInput, ngModel);

        $formInput
            .not('[readonly],[disabled]')
            .attr('ng-disabled', 'vm.loading');


        if ($formGroup.find('mezzo-validation-messages').length == 0) {
            $formGroup
            //.attr('ng-class', `vm.hasError('${ nameAttribute }')`)
                .attr('mezzo-has-error', '')
                .append(validationMessagesTemplate);
        }


        const isSelect = $formInput.is('select');

        if (isSelect) {
            const firstOption = $formInput.children(':first');

            if (firstOption.length) {
                const selectDefaultValue = firstOption.val();

                $formInput.attr('ng-init', ngModel + ` = '${ selectDefaultValue }'`);
            }
        }
    }

    addModelConnection($formInput, ngModelValue) {
        if ($formInput.is('[type=checkbox],[type=radio]')) {
            if ($formInput.attr('ng-checked'))
                return false;

            return $formInput.attr('ng-checked', ngModelValue);
        }

        if ($formInput.attr('ng-model'))
            return false;

        return $formInput.attr('ng-model', ngModelValue);
    }

}