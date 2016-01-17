import EventDaysController from './EventDaysController';

/*@ngInject*/
export default function filePickerDirective() {
    return {
        restrict: 'E',
        templateUrl: '/mezzolabs/mezzo/cockpit/templates/eventDaysDirective.html',
        scope: {
            name: '@'
        },
        controller: EventDaysController,
        controllerAs: 'vm',
        bindToController: true
    };
}