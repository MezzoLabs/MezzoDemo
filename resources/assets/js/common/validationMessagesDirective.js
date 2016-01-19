/*@ngInject*/
export default function validationMessagesDirective() {
    return {
        restrict: 'E',
        templateUrl: '/mezzolabs/mezzo/cockpit/templates/validationMessagesDirective.html',
        scope: {
            formInput: '='
        }
    };
}