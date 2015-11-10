import fileManagerService from './fileManagerService.js';
import draggableDirective from './draggableDirective.js';
import droppableDirective from './droppableDirective.js';
import FileManagerController from './FileManagerController.js';

var module = angular.module('MezzoFileManager', []);

module.factory('fileManager', fileManagerService);
module.directive('mezzoDraggable', draggableDirective);
module.directive('mezzoDroppable', droppableDirective);
module.controller('FileManagerController', FileManagerController);