import SubscriptionsController from './SubscriptionsController';

/*@ngInject*/
export default function subscriptionsDirective() {
    return {
        restrict: 'E',
        templateUrl: '/mezzolabs/mezzo/cockpit/templates/subscriptionsDirective.html',
        scope: {
            naming: '@'
        },
        controller: SubscriptionsController,
        controllerAs: 'vm',
        bindToController: true
    };
}