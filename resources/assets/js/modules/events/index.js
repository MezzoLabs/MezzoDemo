import evenDaysDirective from './eventDaysDirective';
import evenVenueDirective from './eventVenueDirective';

const module = angular.module('MezzoEvents', []);

module.directive('mezzoEventDays', evenDaysDirective);
module.directive('mezzoEventVenue', evenVenueDirective);
