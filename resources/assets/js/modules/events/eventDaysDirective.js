import EventDaysController from './EventDaysController';

/*@ngInject*/
export default function eventDaysDirective() {
    return {
        restrict: 'E',
        templateUrl: '/mezzolabs/mezzo/cockpit/templates/eventDaysDirective.html',
        scope: {
            naming: '@'
        },
        controller: EventDaysController,
        controllerAs: 'vm',
        bindToController: true
    };
}