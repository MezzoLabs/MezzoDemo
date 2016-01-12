import compileDirective from './compileDirective';
import compileHtmlDirective from './compileHtmlDirective';
import enterDirective from './enterDirective.js';
import relationInputDirective from './relationInputDirective';
import hrefReloadDirective from './hrefReloadDirective';
import hrefPreventDirective from './hrefPreventDirective';
import tinymceDirective from './tinymceDirective';
import select2Directive from './select2Directive';
import dateTimePickerDirective from './dateTimePickerDirective';
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
module.directive('mezzoSelect2', select2Directive);
module.directive('mezzoRichtext', tinymceDirective);
module.directive('mezzoDatetimepicker', dateTimePickerDirective);
module.factory('uid', uidService);
module.factory('api', apiService);
module.factory('hasController', hasControllerService);