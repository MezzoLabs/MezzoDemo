/*@ngInject*/
export default function config($locationProvider, $urlRouterProvider, $httpProvider, $interpolateProvider){
    $httpProvider.defaults.headers.common.Accept = 'application/vnd.MezzoLabs.v1+json';

    $locationProvider.html5Mode(true);
    $urlRouterProvider.otherwise('/mezzo');
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}