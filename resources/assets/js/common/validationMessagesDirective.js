/*@ngInject*/
export default function validationMessagesDirective() {
    return {
        restrict: 'E',
        require: '^form',
        templateUrl: '/mezzolabs/mezzo/cockpit/templates/validationMessagesDirective.html',
        scope: {
            formInput: '=',
            formInputName: '@'
        },
        link(scope, element, attributes, formController) {
            scope.getFormInput = getFormInput;

            function getFormInput() {
                if(scope.formInput) {
                    return scope.formInput;
                }

                return formController[scope.formInputName];
            }
        }
    };
}