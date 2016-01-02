import mapDirective from './mapDirective';
import searchDirective from './searchDirective';

const module = angular.module('MezzoGoogleMaps', []);

module.directive('mezzoGoogleMap', mapDirective);
module.directive('mezzoGoogleMapsSearch', searchDirective);