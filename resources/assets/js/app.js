import config from './setup/config';
import stateProvider from './setup/state-provider';
import run from './setup/run';
import register from './register';
import './modules/file-manager';

var app = angular.module('Mezzo', [
    'ui.router',
    'templates',
    'angular-sortable-view',
    'ngFileUpload',
    'ngMessages',
    'MezzoFileManager'
]);

app.config(config);
stateProvider(app);
app.run(run);
register(app);