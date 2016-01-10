/*@ngInject*/
export default function filePickerValueDirective() {
    return {
        require: '^mezzoFilePicker',
        restrict: 'A',
        link
    };

    function link(scope, element, attributes, controller) {
        scope.$watch(() => $(element).val(), (newValue, oldValue) => {
            if(newValue === oldValue || newValue === undefined) {
                return;
            }

            controller.acquireInputValue(newValue);
        });
    }
}