import './setup/jquery';
import './modules/resource';
import './modules/fileManager';
import './modules/contentBuilder';
import config from './setup/config';
import compileDirective from './common/compileDirective';
import enterDirective from './common/enterDirective.js';
import uidService from './common/uidService.js';
import apiService from './common/api/apiService';

var app = angular.module('Mezzo', [
    'ui.router',
    'ngMessages',
    'angular-sortable-view',
    'ngFileUpload',
    'MezzoResources',
    'MezzoFileManager',
    'MezzoContentBuilder'
]);

app.config(config);
app.directive('mezzoCompile', compileDirective);
app.directive('mezzoEnter', enterDirective);
app.factory('uid', uidService);
app.factory('api', apiService);