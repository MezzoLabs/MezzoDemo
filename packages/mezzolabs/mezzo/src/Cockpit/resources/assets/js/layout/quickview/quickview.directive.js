export default { name: 'mezzoQuickview', directive };

/*@ngInject*/ function directive(quickview){
    return {
        restrict: 'E',
        templateUrl: 'layout/quickview/quickview.html',
        link
    };

    function link(){
        $('#quickview .btn-close, #view-overlay').click(function(){
            quickview.setVisible(false);
        });
    }
}