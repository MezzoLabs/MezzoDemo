import states from './states';

export default config;

/*@ngInject*/ function config($locationProvider, $stateProvider, $urlRouterProvider){
    $locationProvider.html5Mode(true);
    $urlRouterProvider.otherwise('/mezzo');
    states.forEach(state => $stateProvider.state(state.name, state.route));
}