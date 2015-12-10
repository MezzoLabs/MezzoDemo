import contentBlockService from './contentBlockService';
import CreatePageController from './CreatePageController';
import CreatePostController from './CreatePostController';

var module = angular.module('MezzoContentBuilder', []);

module.factory('contentBlockService', contentBlockService);
module.controller('CreatePageController', CreatePageController);
module.controller('CreatePostController', CreatePostController);