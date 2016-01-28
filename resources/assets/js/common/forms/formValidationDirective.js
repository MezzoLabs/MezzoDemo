/*@ngInject*/
export default function formValidationDirective(formValidationService) {
    return {
        restrict: 'A',
        compile
    };

    function compile(element) {
        $(element)
            .find(':input')
            .each((index, formInput) => {
                formValidationService.assign(formInput);
            });
    }
}