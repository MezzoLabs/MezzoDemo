/*@ngInject*/
export default function assignNgModelDirective($compile) {
    return {
        restrict: 'A',
        compile
    };

    function compile(element) {
        $(element).find(':input').each((index, formInput) => {
            const nameAttribute = $(formInput).attr('name');

            if (!nameAttribute) {
                return;
            }

            $(formInput)
                .attr('ng-model', `vm.inputs['${ nameAttribute }']`)
                .parents('.form-group')
                .attr('ng-class', `vm.hasError('${ nameAttribute }')`)
                .prepend(`<mezzo-validation-messages data-form-input="vm.form['${ nameAttribute }']"></mezzo-validation-messages>`);
        });
    }
}