export default function droppableDirective(){
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes){
        var $element = $(element);
        var droppable = attributes.mezzoDroppable;
        var controller = scope.vm;

        if(droppable === 'true') {
            $element.droppable({
                hoverClass: 'success',
                drop: (event, ui) => {
                    var draggable = ui.draggable;

                    ui.helper.remove();
                    controller.onDrop(element, draggable);
                }
            });
        }
    }
}