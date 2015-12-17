import draggableDirective from './draggableDirective.js';
import droppableDirective from './droppableDirective.js';
import filePickerDirective from './filePickerDirective';
import CreateFileController from './CreateFileController';

var module = angular.module('MezzoFileManager', []);

module.directive('mezzoDraggable', draggableDirective);
module.directive('mezzoDroppable', droppableDirective);
module.directive('mezzoFilePicker', filePickerDirective);
module.controller('CreateFileController', CreateFileController);