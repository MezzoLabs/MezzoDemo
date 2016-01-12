/*@ngInject*/
export default function tinymceDirective() {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes) {
        var elementClass = 'tinymce_' + parseInt(Math.random() * 999);
        $(element).addClass(elementClass);

        tinyMCE.init({
            'selector' : '.' + elementClass
        });
    }
}