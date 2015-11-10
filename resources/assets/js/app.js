import './setup/jquery';
import './modules/file-manager';
import config from './setup/config';
import stateProvider from './setup/stateProvider';
import compileDirective from './common/compileDirective';
import enterDirective from './common/enterDirective.js';
import registerStateDirective from './common/registerStateDirective.js';
import uidService from './common/uidService.js';

var app = angular.module('Mezzo', [
    'ui.router',
    'ngMessages',
    'angular-sortable-view',
    'ngFileUpload',
    'MezzoFileManager'
]);

app.config(config);
app.provider('$stateProvider', stateProvider);
app.directive('mezzoCompile', compileDirective);
app.directive('mezzoEnter', enterDirective);
app.directive('mezzoRegisterState', registerStateDirective);
app.factory('uid', uidService);