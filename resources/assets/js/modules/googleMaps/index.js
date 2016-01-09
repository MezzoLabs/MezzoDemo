import mapService from './mapService';
import mapDirective from './mapDirective';
import searchDirective from './searchDirective';

const module = angular.module('MezzoGoogleMaps', []);

module.factory('mapService', mapService);
module.directive('mezzoGoogleMap', mapDirective);
module.directive('mezzoGoogleMapsSearch', searchDirective);