import RelationInputController from './RelationInputController';

/*@ngInject*/
export default function relationInputDirective() {
    return {
        restrict: 'E',
        templateUrl: '/mezzolabs/mezzo/cockpit/templates/relationInputDirective.html',
        replace: true,
        scope: {
            related: '@',
            multiple: '@'
        },
        controller: RelationInputController,
        controllerAs: 'vm',
        bindToController: true
    };
}