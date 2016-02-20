/*@ngInject*/
export default function validationMessagesDirective(formInputService) {
    return {
        restrict: 'E',
        require: '^form',
        templateUrl: '/mezzolabs/mezzo/cockpit/templates/validationMessagesDirective.html',
        scope: true,
        link
    };

    function link(scope, element, attributes, formController) {
        scope.formInput = undefined;
        const inputElement = $(element).siblings(':input[name]').first();

        if (!inputElement.length) {
            console.warn('Mezzo validation messages directive is unable to find its corresponding input element with a name!', element);
            return;
        }

        formInputService.getFormInputByElement(inputElement, scope, formController)
            .then(formInput => {
                scope.formInput = formInput;
            })
            .catch(err => console.error(err));
    }
}