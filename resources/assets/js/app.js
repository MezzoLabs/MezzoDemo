import './setup/jquery';
import './modules/resource';
import './modules/fileManager';
import config from './setup/config';
import compileDirective from './common/compileDirective';
import enterDirective from './common/enterDirective.js';
import uidService from './common/uidService.js';

var app = angular.module('Mezzo', [
    'ui.router',
    'ngMessages',
    'angular-sortable-view',
    'ngFileUpload',
    'MezzoFileManager',
    'MezzoResources'
]);

app.config(config);
app.directive('mezzoCompile', compileDirective);
app.directive('mezzoEnter', enterDirective);
app.factory('uid', uidService);