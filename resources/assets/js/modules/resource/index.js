import stateProvider from './stateProvider';
import hasControllerService from './hasControllerService';
import registerStateDirective from './registerStateDirective';
import IndexController from './ResourceIndexController';
import CreateController from './ResourceCreateController';
import EditController from './ResourceEditController';

var module = angular.module('MezzoResources', []);

module.provider('$stateProvider', stateProvider);
module.directive('mezzoRegisterState', registerStateDirective);
module.factory('hasController', hasControllerService);
module.controller('ResourceIndexController', IndexController);
module.controller('ResourceCreateController', CreateController);
module.controller('ResourceEditController', EditController);