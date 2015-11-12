import ContentBuilderController from './ContentBuilderController';

var module = angular.module('MezzoContentBuilder', [ 'ui.router' ]);

module.config($stateProvider => {
    $stateProvider.state('ContentBuilder', {
        url: '/mezzo/content-builder',
        templateUrl: 'mezzo/file-manager/file/create.html',
        controller: 'ContentBuilderController',
        controllerAs: 'vm'
    });
});

module.controller('ContentBuilderController', ContentBuilderController);