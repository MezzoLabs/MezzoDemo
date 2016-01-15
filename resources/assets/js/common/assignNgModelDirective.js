/*@ngInject*/
export default function assignNgModelDirective($compile) {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes) {
        $(element).find(':input').each((index, formInput) => {
            const nameAttribute = $(formInput).attr('name');

            if (!nameAttribute) {
                return;
            }

            const valueBeforeCompile = $(formInput).val();

            $(formInput).attr('ng-model', `vm.form['${ nameAttribute }']`);
            $compile(formInput)(scope);

            scope.vm.form[nameAttribute] = valueBeforeCompile;
        });
    }
}