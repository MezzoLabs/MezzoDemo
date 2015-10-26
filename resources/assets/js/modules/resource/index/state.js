import State from '../../../common/State';

export default new State('resource-index', 'model/list', {
    main: {
        templateUrl: '/mezzo/sample/tutorial/index.html',
        controller: 'ResourceIndexController',
        controllerAs: 'vm'
    }
});