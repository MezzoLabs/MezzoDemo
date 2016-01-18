import './setup/jquery';
import './common';
import './modules/resource';
import './modules/fileManager';
import './modules/events';
import './modules/users';
import './modules/contentBlocks';
import './modules/googleMaps';
import config from './setup/config';

const app = angular.module('Mezzo', [
    'ui.router',
    'ui.sortable',
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