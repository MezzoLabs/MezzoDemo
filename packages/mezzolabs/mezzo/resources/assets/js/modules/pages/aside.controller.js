export default { name: 'PagesAsideController', controller };

/*@ngInject*/ function controller($scope){
    $scope.addWidget = addWidget;

    function addWidget(){
        var gridster = $('div.gridster').gridster().data('gridster');

        gridster.add_widget('<div class="panel panel-bordered"><i class="ion-close"></i></div>');

        $('.panel .ion-close').click(function(){
            gridster.remove_widget($(this).parent('.panel'));
        });
    }
}