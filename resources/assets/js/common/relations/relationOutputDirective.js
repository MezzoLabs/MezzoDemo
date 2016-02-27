import RelationOutputController from './RelationOutputController';

/*@ngInject*/
export default function relationInputDirective() {
    return {
        restrict: 'E',
        templateUrl: '/mezzolabs/mezzo/cockpit/templates/relationOutputDirective.html',
        replace: true,
        scope: {
            related: '@',
            scopes: '@',
            naming: '@',
            title: '@'
        },
        require: "^form",
        controller: RelationOutputController,
        controllerAs: 'vm',
        bindToController: true
    };
}