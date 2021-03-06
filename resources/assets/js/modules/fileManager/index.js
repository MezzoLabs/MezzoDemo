import draggableDirective from './draggableDirective.js';
import droppableDirective from './droppableDirective.js';
import filePickerDirective from './filePickerDirective';
import filePickerValueDirective from './filePickerValueDirective';
import FileManagerController from './FileManagerController';

const module = angular.module('MezzoFileManager', []);

module.directive('mezzoDraggable', draggableDirective);
module.directive('mezzoDroppable', droppableDirective);
module.directive('mezzoFilePicker', filePickerDirective);
//module.directive('mezzoFilePickerValue', filePickerValueDirective);
module.controller('CreateFileController', FileManagerController);