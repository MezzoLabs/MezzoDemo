import compileDirective from './compileDirective';
import compileHtmlDirective from './compileHtmlDirective';
import enterDirective from './enterDirective.js';
import relationInputDirective from './relationInputDirective';
import hrefReloadDirective from './hrefReloadDirective';
import uidService from './uidService.js';
import apiService from './api/apiService';
import randomService from './randomService';
import hasControllerService from './hasControllerService';

const module = angular.module('MezzoCommon', []);

module.directive('mezzoCompile', compileDirective);
module.directive('mezzoCompileHtml', compileHtmlDirective);
module.directive('mezzoEnter', enterDirective);
module.directive('mezzoRelationInput', relationInputDirective);
module.directive('mezzoHrefReload', hrefReloadDirective);
module.factory('uid', uidService);
module.factory('api', apiService);
module.factory('random', randomService);
module.factory('hasController', hasControllerService);