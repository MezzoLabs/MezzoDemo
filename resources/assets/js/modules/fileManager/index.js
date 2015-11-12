import fileManagerService from './fileManagerService.js';
import draggableDirective from './draggableDirective.js';
import droppableDirective from './droppableDirective.js';
import FileManagerController from './FileManagerController.js';

var module = angular.module('MezzoFileManager', [ 'ui.router' ]);

module.config($stateProvider => {
    $stateProvider.state('FileManager', {
        url: '/mezzo/file-manager',
        templateUrl: 'mezzo/file-manager/file/create.html',
        controller: 'FileManagerController',
        controllerAs: 'vm'
    });
});

module.factory('fileManager', fileManagerService);
module.directive('mezzoDraggable', draggableDirective);
module.directive('mezzoDroppable', droppableDirective);
module.controller('FileManagerController', FileManagerController);