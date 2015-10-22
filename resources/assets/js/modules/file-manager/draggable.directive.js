export default { name: 'mezzoDraggable', directive };

/*@ngInject*/ function directive(){
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