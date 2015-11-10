import State from '../../common/State';

var state = new State('FileManager', 'filemanager', {
    main: {
        templateUrl: 'mezzo/filemanager/file/create.html',
        controller: 'FileManagerController as vm'
    }
});



import fileManagerService from './fileManagerService.js';
import draggableDirective from './draggableDirective.js';
import droppableDirective from './droppableDirective.js';
import FileManagerController from './FileManagerController.js';

var module = angular.module('MezzoFileManager', [ 'ui.router' ]);

module.config($stateProvider => {
    $stateProvider.state(state.name, state.route)
});

module.factory('fileManager', fileManagerService);
module.directive('mezzoDraggable', draggableDirective);
module.directive('mezzoDroppable', droppableDirective);
module.controller('FileManagerController', FileManagerController);