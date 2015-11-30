/*@ngInject*/
export default function filePickerDirective() {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes) {
        $(element).click(showFilePickerModal);
    }

    function showFilePickerModal(){
        $('#mezzoFilePickerModal').modal();
    }
}