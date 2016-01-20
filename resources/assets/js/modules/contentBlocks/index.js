import contentBlockFactory from './contentBlockFactory';
import compileContentBlockDirective from './compileContentBlockDirective';

const module = angular.module('MezzoContentBlocks', []);

module.factory('contentBlockFactory', contentBlockFactory);
module.directive('mezzoCompileContentBlock', compileContentBlockDirective);