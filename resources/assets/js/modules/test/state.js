import State from '../../common/State';

export default new State('test', 'sample/tutorial/index', {
    main: {
        templateUrl: '/mezzo/sample/tutorial/index.html',
        controller: 'TestMainController',
        controllerAs: 'vm'
    }
});