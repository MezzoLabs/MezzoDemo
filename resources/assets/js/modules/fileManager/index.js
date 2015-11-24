import draggableDirective from './draggableDirective.js';
import droppableDirective from './droppableDirective.js';
import CreateFileController from './CreateFileController.js';

var module = angular.module('MezzoFileManager', []);

module.directive('mezzoDraggable', draggableDirective);
module.directive('mezzoDroppable', droppableDirective);
module.controller('CreateFileController', CreateFileController);