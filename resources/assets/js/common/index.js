import compileDirective from './compileDirective';
import enterDirective from './enterDirective.js';
import relationInputDirective from './relationInputDirective';
import hrefReloadDirective from './hrefReloadDirective';
import hrefPreventDirective from './hrefPreventDirective';
import tinymceDirective from './tinymceDirective';
import select2Directive from './select2Directive';
import dateTimePickerDirective from './dateTimePickerDirective';
import quickviewDirective from './quickviewDirective';
import quickviewCloseDirective from './quickviewCloseDirective';
import formValidationDirective from './forms/formValidationDirective';
import validationMessagesDirective from './validationMessagesDirective';
import globalSearchDirective from './globalsearch/globalSearchDirective';
import uidService from './uidService.js';
import apiService from './api/apiService';
import hasControllerService from './hasControllerService';
import QuickviewService from './QuickviewService';
import FormValidationService from './forms/FormValidationService';
import LanguageService from './LanguageService';
import ErrorHandlerService from './ErrorHandlerService';
import EventDispatcherService from './events/EventDispatcherService';
import httpInterceptorFactory from './api/httpInterceptorFactory';
import HttpRequestTrackerService from './api/HttpRequestTrackerService';

const module = angular.module('MezzoCommon', []);

module.directive('mezzoCompile', compileDirective);
module.directive('mezzoEnter', enterDirective);
module.directive('mezzoRelationInput', relationInputDirective);
module.directive('mezzoHrefReload', hrefReloadDirective);
module.directive('mezzoHrefPrevent', hrefPreventDirective);
module.directive('mezzoSelect2', select2Directive);
module.directive('mezzoRichtext', tinymceDirective);
module.directive('mezzoDatetimepicker', dateTimePickerDirective);
module.directive('mezzoQuickview', quickviewDirective);
module.directive('mezzoQuickviewClose', quickviewCloseDirective);
module.directive('mezzoFormValidation', formValidationDirective);
module.directive('mezzoValidationMessages', validationMessagesDirective);
module.directive('mezzoGlobalsearch', globalSearchDirective);
module.factory('uid', uidService);
module.factory('api', apiService);
module.factory('hasController', hasControllerService);
module.service('quickviewService', QuickviewService);
module.service('formValidationService', FormValidationService);
module.service('errorHandlerService', ErrorHandlerService);
module.service('languageService', LanguageService);
module.service('eventDispatcher', EventDispatcherService);
module.factory('httpInterceptor', httpInterceptorFactory).config(function ($httpProvider) {
    $httpProvider.interceptors.push('httpInterceptor');
});
module.service('HttpRequestTracker', HttpRequestTrackerService);
