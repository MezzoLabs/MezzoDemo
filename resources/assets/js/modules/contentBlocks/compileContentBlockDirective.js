/*@ngInject*/
export default function compileContentBlockDirective($parse, $compile, formValidationService, eventdistr){
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes){
        const expression = attributes.mezzoCompileContentBlock;
        const getter = $parse(expression);

        scope.$watch(getter, html => {
            if(!html){
                return;
            }

            element.html(html);
            deferFormValidation(element);
            $compile(element.contents())(scope);
        });

        function deferFormValidation(element) {
            setTimeout(() => {
                assignFormValidation(element);
            }, 1);
        }

        function assignFormValidation(element) {
            element
                .find('div.form-group :input')
                .each((index, formInput) => {
                    formValidationService.assign(formInput);
                });
            $compile(element.contents())(scope);
        }
    }
}