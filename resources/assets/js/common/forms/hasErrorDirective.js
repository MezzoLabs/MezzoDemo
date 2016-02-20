/*@ngInject*/
export default function hasErrorDirective(formInputService) {
    return {
        restrict: 'A',
        require: '^form',
        link
    };

    function link(scope, element, attributes, formController) {
        const inputElement = findInputWithinElement(element);

        if (!inputElement.length) {
            console.warn('Mezzo has error directive is unable to find input with a name within its children!', element);
            return;
        }

        formInputService.getFormInputByElement(inputElement, scope, formController)
            .then(formInput => {
                scope.$watch(() => formInput.$valid, onFormInputChange);
                scope.$watch(() => formInput.$dirty, onFormInputChange);

                function onFormInputChange() {
                    const isDirty = formInput.$dirty;
                    const isValid = formInput.$valid;

                    if (!isDirty) {
                        return;
                    }

                    $(element).toggleClass('has-error', !isValid);
                }
            })
            .catch(err => console.error(err));

        function findInputWithinElement(element) {
            return $(element).children(':input[name]').first();
        }
    }
}