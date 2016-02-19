import EventDaysController from './EventDaysController';

/*@ngInject*/
export default function eventDaysDirective() {
    return {
        restrict: 'E',
        templateUrl: '/mezzolabs/mezzo/cockpit/templates/eventDaysDirective.html',
        scope: {
            naming: '@'
        },
        require: '^form',
        controller: EventDaysController,
        controllerAs: 'vm',
        bindToController: true,
        link: function(scope, element, attrs, ctrls){
            scope.vm.linked(scope, element, attrs, ctrls);
        }
    };
}