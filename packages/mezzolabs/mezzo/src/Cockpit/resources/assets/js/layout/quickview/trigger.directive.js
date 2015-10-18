export default { name: 'mezzoQuickview', directive };

/*@ngInject*/ function directive(quickview){
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attrs){
        $(element).click(() => {
            quickview.setVisible(!quickview.isVisible());
            return false;
        });
    }
}