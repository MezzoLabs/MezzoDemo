export default function draggableDirective(){
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes){
        $(element).draggable({
            axis: 'y',
            containment: 'table',
            helper: 'clone',
            revert: true
        });
    }
}