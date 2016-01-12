/*@ngInject*/
export default function tinymceDirective() {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes) {
        var elementId = 'tinymce_textarea-' + parseInt(Math.random() * 999);
        $(element).addClass('tinymce_textarea ' + elementId);
        $(element).attr('id', elementId);

        tinyMCE.init({
            plugins: [
                "link"
            ],
            selector : '.' + elementId,
            toolbar: "undo redo | bold italic underline | link",
            menubar: "",
            elementpath: false
        });
    }
}