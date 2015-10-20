import config from './setup/config';
import run from './setup/run';
import register from './register';

var app = angular.module('Mezzo', [ 'ui.router', 'templates', 'angular-sortable-view', 'ngFileUpload' ]);

app.config(config);
app.run(run);
register(app);