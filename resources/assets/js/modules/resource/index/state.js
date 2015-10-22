import State from '../../../common/State';

export default new State('resource', 'sample/tutorial/index', {
    main: {
        templateUrl: '/mezzo/sample/tutorial/index.html',
        controller: 'ResourceIndexController',
        controllerAs: 'vm'
    }
});