/*@ngInject*/
export default function tinymceDirective() {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes) {


        $(element).tinymce({

        });
    }
}