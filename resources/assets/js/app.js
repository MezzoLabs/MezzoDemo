import './setup/jquery';
import './common';
import './modules/resource';
import './modules/fileManager';
import './modules/events';
import './modules/users';
import './modules/contentBlocks';
import './modules/googleMaps';
import config from './setup/config';
import run from './setup/run';

const app = angular.module('Mezzo', [
    'ui.router',
    'ui.sortable',
    'ui.bootstrap',
    'ui.tinymce',
    'pascalprecht.translate',
    'ngMessages',
    'angular-sortable-view',
    'angular-loading-bar',
    'ngFileUpload',
    'MezzoCommon',
    'MezzoResources',
    'MezzoFileManager',
    'MezzoEvents',
    'MezzoUsers',
    'MezzoContentBlocks',
    'MezzoGoogleMaps'
]);

app.config(config);
app.run(run);
