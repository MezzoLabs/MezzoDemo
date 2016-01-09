import stateProvider from './stateProvider';
import formDataService from './formDataService';
import registerStateDirective from './registerStateDirective';
import IndexResourceController from './IndexResourceController';
import CreateResourceController from './CreateResourceController';
import EditResourceController from './EditResourceController';
import ShowResourceController from './ShowResourceController';

const module = angular.module('MezzoResources', []);

module.provider('$stateProvider', stateProvider);
module.service('formDataService', formDataService);
module.directive('mezzoRegisterState', registerStateDirective);
module.controller('IndexResourceController', IndexResourceController);
module.controller('CreateResourceController', CreateResourceController);
module.controller('EditResourceController', EditResourceController);
module.controller('ShowResourceController', ShowResourceController);