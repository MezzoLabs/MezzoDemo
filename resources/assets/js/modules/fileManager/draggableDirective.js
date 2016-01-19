export default function draggableDirective(){
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes){
        const droppable = attributes.mezzoDraggable;

        if(droppable === 'false') {
            return;
        }

        $(element).draggable({
            axis: 'y',
            containment: 'table',
            helper: 'clone',
            revert: true
        });
    }
}