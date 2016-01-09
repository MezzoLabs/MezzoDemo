import './setup/jquery';
import './modules/resource';
import './modules/fileManager';
import './modules/contentBuilder';
import config from './setup/config';
import compileDirective from './common/compileDirective';
import compileHtmlDirective from './common/compileHtmlDirective';
import enterDirective from './common/enterDirective.js';
import relationInputDirective from './common/relationInputDirective';
import uidService from './common/uidService.js';
import apiService from './common/api/apiService';
import randomService from './common/randomService';
import hasControllerService from './common/hasControllerService';

var app = angular.module('Mezzo', [
    'ui.router',
    'ui.sortable',
    'ngMessages',
    'angular-sortable-view',
    'angular-loading-bar',
    'ngFileUpload',
    'MezzoResources',
    'MezzoFileManager',
    'MezzoContentBuilder'
]);

app.config(config);
app.directive('mezzoCompile', compileDirective);
app.directive('mezzoCompileHtml', compileHtmlDirective);
app.directive('mezzoEnter', enterDirective);
app.directive('mezzoRelationInput', relationInputDirective);
app.factory('uid', uidService);
app.factory('api', apiService);
app.factory('random', randomService);
app.factory('hasController', hasControllerService);
