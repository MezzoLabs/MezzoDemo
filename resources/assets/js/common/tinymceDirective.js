/*@ngInject*/
export default function tinymceDirective() {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes) {
        var elementClass = 'tinymce_' + parseInt(Math.random() * 999);
        $(element).addClass(elementClass);

        alert('5');

        tinyMCE.init({
            plugins: [
                "link"
            ],
            selector : '.' + elementClass,
            toolbar: "undo redo | bold italic underline | link",
            menubar: "",
            elementpath: false
        });
    }
}