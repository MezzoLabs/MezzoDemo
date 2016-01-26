/*@ngInject*/
export default function compileContentBlockDirective($parse, $compile, formValidationService, eventDispatcher) {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes) {
        const expression = attributes.mezzoCompileContentBlock;
        const getter = $parse(expression);

        scope.$watch(getter, html => {
            if (!html) {
                return;
            }

            element.html(html);
            deferFormValidation(element);
            $compile(element.contents())(scope);
        });

        eventDispatcher.on('form.updated', (event, payload) => onUpdate(payload));

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

        function onUpdate(data) {
            var $idInput = element.find('[name$=".id"]');
            var id = data.flattened[$idInput.attr('name')];

            //TODO: Find the right input via the api response (send a unique handle / sort
            //$idInput.val(id);
        }
    }
}