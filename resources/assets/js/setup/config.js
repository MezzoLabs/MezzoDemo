import states from './states';

export default config;

/*@ngInject*/ function config($locationProvider, $stateProvider, $urlRouterProvider, $httpProvider){
    $httpProvider.defaults.headers.common.accept = 'application/vnd.MezzoLabs.v1+json';

    $locationProvider.html5Mode(true);
    $urlRouterProvider.otherwise('/mezzo');
    states.forEach(state => $stateProvider.state(state.name, state.route));
}