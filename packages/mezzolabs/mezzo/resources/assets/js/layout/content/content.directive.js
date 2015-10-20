export default { name: 'mezzoContent', directive };

/*@ngInject*/ function directive(quickview){
    return {
        restrict: 'E',
        templateUrl: 'layout/content/content.html',
        link
    };

    function link(){
        $('#content-main').click(function(){
            quickview.setVisible(false);
        });
    }
}