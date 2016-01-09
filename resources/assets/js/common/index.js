import compileDirective from './compileDirective';
import compileHtmlDirective from './compileHtmlDirective';
import enterDirective from './enterDirective.js';
import relationInputDirective from './relationInputDirective';
import hrefReloadDirective from './hrefReloadDirective';
import hrefPreventDirective from './hrefPreventDirective';
import uidService from './uidService.js';
import apiService from './api/apiService';
import hasControllerService from './hasControllerService';

const module = angular.module('MezzoCommon', []);

module.directive('mezzoCompile', compileDirective);
module.directive('mezzoCompileHtml', compileHtmlDirective);
module.directive('mezzoEnter', enterDirective);
module.directive('mezzoRelationInput', relationInputDirective);
module.directive('mezzoHrefReload', hrefReloadDirective);
module.directive('mezzoHrefPrevent', hrefPreventDirective);
module.factory('uid', uidService);
module.factory('api', apiService);
module.factory('hasController', hasControllerService);