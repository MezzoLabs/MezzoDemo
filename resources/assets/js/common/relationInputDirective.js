import RelationInputController from './RelationInputController';

/*@ngInject*/
export default function relationInputDirective() {
    return {
        restrict: 'E',
        templateUrl: '/mezzolabs/mezzo/cockpit/templates/relationInputDirective.html',
        replace: true,
        scope: {
            related: '@',
            scopes: '@'
        },
        require: "^form",
        controller: RelationInputController,
        controllerAs: 'vm',
        bindToController: true,
        link: function(scope, element, attrs, ctrls){
            scope.vm.linked(scope, element, attrs, ctrls);
        }
    };
}