import config from './setup/config';
import addState from './setup/add-state';
import run from './setup/run';
import register from './register';

var app = angular.module('Mezzo', ['ui.router', 'templates', 'angular-sortable-view', 'ngFileUpload', 'ngMessages']);

app.config(config);
addState(app);
app.run(run);
register(app);