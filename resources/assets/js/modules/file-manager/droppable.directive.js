export default { name: 'mezzoDroppable', directive };

/*@ngInject*/ function directive(fileManager){
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes){
        var $element = $(element);
        var droppable = attributes.mezzoDroppable;

        if(droppable === 'true') {
            $element.droppable({
                hoverClass: 'success',
                drop: (event, ui) => {
                    var {draggable} = ui;

                    ui.helper.remove();
                    fileManager.drop(element, draggable);
                }
            });
        }
    }
}