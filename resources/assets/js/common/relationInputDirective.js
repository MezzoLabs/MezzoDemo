import RelationInputController from './RelationInputController';

/*@ngInject*/
export default function relationInputDirective() {
    return {
        restrict: 'E',
        templateUrl: '/mezzolabs/mezzo/cockpit/templates/relationInputDirective.html',
        replace: true,
        scope: {
            related: '@',
            required: '@'
        },
        controller: RelationInputController,
        controllerAs: 'vm',
        bindToController: true
    };
}