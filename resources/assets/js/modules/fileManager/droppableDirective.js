/*@ngInject*/
export default function droppableDirective(fileManager){
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
                    fileManager.onDrop(element, draggable);
                }
            });
        }
    }
}