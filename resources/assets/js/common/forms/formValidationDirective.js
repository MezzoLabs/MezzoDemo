/*@ngInject*/
export default function formValidationDirective(formValidationService, eventDispatcher, $compile) {
    return {
        restrict: 'A',
        compile
    };

    function compile(element) {
        eventDispatcher.on('form.received', (event, payload) => {
            setTimeout(() => {
                assignTo($(element));
            }, 1);
        });

        assignTo($(element));
    }

    function assignTo(formElement) {
        $(formElement)
            .find(':input')
            .each((index, formInput) => {
                formValidationService.assign(formInput);
            });
    }
}